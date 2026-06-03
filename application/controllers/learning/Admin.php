<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!class_exists("My_Controller"))
    include_once APPPATH . 'core/My_Controller.php';

class Admin extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_admin('projects');
        $this->load->model('learning/Internship_model', 'internship_model');
    }

    public function manage_videos()
    {
        $internships = $this->internship_model->get_all();
        // Count uploaded videos for each internship
        foreach ($internships as $i) {
            $i->video_count = $this->db->where('internship_id', $i->id)->count_all_results('internship_videos');
        }

        $this->loadview('learning/admin/manage_videos', [
            'page_title'  => 'Manage Course Videos',
            'internships' => $internships,
            'use_admin_shell' => true,
        ], 'projects/project_layout');
    }

    public function internship_videos($internship_id)
    {
        $internship = $this->internship_model->find($internship_id);
        if (!$internship) {
            show_404();
        }

        $videos = $this->db->where('internship_id', $internship_id)
                           ->order_by('order_no', 'ASC')
                           ->order_by('id', 'ASC')
                           ->get('internship_videos')
                           ->result();

        $this->loadview('learning/admin/internship_videos', [
            'page_title' => 'Manage Internship Videos - ' . $internship->title,
            'internship' => $internship,
            'videos'     => $videos,
            'use_admin_shell' => true,
        ], 'projects/project_layout');
    }

    public function add_internship_video($internship_id)
    {
        $internship = $this->internship_model->find($internship_id);
        if (!$internship) {
            show_404();
        }

        if ($this->input->method() === 'post') {
            $title = trim($this->input->post('title', true));
            $description = trim($this->input->post('description', true));
            $video_source = $this->input->post('video_source', true); // 'youtube' or 'upload'
            $duration = trim($this->input->post('duration', true)) ?: '10:00';
            $order_no = (int) $this->input->post('order_no', true);

            $video_url = '';

            if ($video_source === 'youtube') {
                $youtube_url = trim($this->input->post('youtube_url', true));
                // Convert watch URL to embed URL if needed
                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $youtube_url, $match)) {
                    $video_url = 'https://www.youtube.com/embed/' . $match[1];
                } else {
                    $video_url = $youtube_url;
                }
            } elseif ($video_source === 'upload') {
                if (!empty($_FILES['video_file']['name'])) {
                    $config['upload_path']   = './uploads/videos/';
                    $config['allowed_types'] = 'mp4|webm|ogg|mkv|mov';
                    $config['max_size']      = 102400; // 100MB max for local upload

                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, true);
                    }

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    
                    if ($this->upload->do_upload('video_file')) {
                        $upload_data = $this->upload->data();
                        $video_url = 'uploads/videos/' . $upload_data['file_name'];
                    } else {
                        $error = $this->upload->display_errors('', '');
                        $this->session->set_flashdata('project_error', 'Video upload failed: ' . $error);
                        redirect('learning/admin/internship_videos/' . $internship_id);
                        return;
                    }
                } else {
                    $this->session->set_flashdata('project_error', 'Please select a video file to upload.');
                    redirect('learning/admin/internship_videos/' . $internship_id);
                    return;
                }
            }

            if (!empty($title) && !empty($video_url)) {
                $this->db->insert('internship_videos', [
                    'internship_id' => $internship_id,
                    'title'         => $title,
                    'description'   => $description,
                    'video_url'     => $video_url,
                    'duration'      => $duration,
                    'order_no'      => $order_no
                ]);
                $this->session->set_flashdata('project_ok', 'Video added successfully!');
            } else {
                $this->session->set_flashdata('project_error', 'Failed to add video. Make sure all required fields are filled.');
            }
        }

        redirect('learning/admin/internship_videos/' . $internship_id);
    }

    public function delete_internship_video($internship_id, $video_id)
    {
        $video = $this->db->get_where('internship_videos', ['id' => $video_id, 'internship_id' => $internship_id])->row();
        if ($video) {
            // Delete local file if it exists and is an upload
            if (strpos($video->video_url, 'uploads/videos/') === 0 && file_exists('./' . $video->video_url)) {
                unlink('./' . $video->video_url);
            }
            $this->db->where('id', $video_id)->delete('internship_videos');
            $this->session->set_flashdata('project_ok', 'Video deleted successfully.');
        } else {
            $this->session->set_flashdata('project_error', 'Video not found.');
        }

        redirect('learning/admin/internship_videos/' . $internship_id);
    }
}
