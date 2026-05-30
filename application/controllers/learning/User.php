<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!class_exists("My_Controller"))
    include_once APPPATH . 'core/My_Controller.php';

class User extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_login();
        
        // If Admin tries to access user dashboard, redirect to admin panel
        if ($this->session->userdata('role_id') == 1) {
            redirect('projects/admin');
        }

        $this->load->model('projects/Internship_user_model');
    }

    public function learning($selected_video_id = NULL)
    {
        $user_id = $this->session->userdata('user_id');
        $user_data = $this->internship_user_model->get_by_id($user_id);
        
        // Find internship IDs the student applied for
        $applied_internships = $this->db->select('internship_id')
                                        ->where('user_id', $user_id)
                                        ->get('internship_applications')
                                        ->result_array();
        
        $internship_ids = array_column($applied_internships, 'internship_id');
        
        if (!empty($user_data->applied_for)) {
            $matching_internships = $this->db->select('id')
                                            ->group_start()
                                                ->like('category', $user_data->applied_for)
                                                ->or_like('title', $user_data->applied_for)
                                            ->group_end()
                                            ->get('internships')
                                            ->result_array();
            
            $matched_ids = array_column($matching_internships, 'id');
            $internship_ids = array_unique(array_merge($internship_ids, $matched_ids));
        }

        // Fetch videos
        $videos = [];
        if (!empty($internship_ids)) {
            $videos = $this->db->select('iv.*, i.title as internship_title')
                               ->from('internship_videos iv')
                               ->join('internships i', 'i.id = iv.internship_id', 'left')
                               ->where_in('iv.internship_id', $internship_ids)
                               ->order_by('iv.order_no', 'ASC')
                               ->order_by('iv.id', 'ASC')
                               ->get()
                               ->result();
        }

        // Determine which video is selected
        $selected_video = NULL;
        if (!empty($videos)) {
            if ($selected_video_id) {
                foreach ($videos as $v) {
                    if ($v->id == $selected_video_id) {
                        $selected_video = $v;
                        break;
                    }
                }
            }
            if (!$selected_video) {
                $selected_video = $videos[0];
            }
        }

        // Fetch comments for the selected video
        $comments = [];
        if ($selected_video) {
            $comments = $this->db->where('video_id', $selected_video->id)
                                 ->order_by('created_at', 'DESC')
                                 ->get('video_comments')
                                 ->result();
        }

        // Load the view directly (bypassing the standard layout wrapper) for a custom immersive design
        $this->load->view('learning/user/learning', [
            'page_title'     => 'Learning Portal',
            'videos'         => $videos,
            'selected_video' => $selected_video,
            'user_data'      => $user_data,
            'comments'       => $comments
        ]);
    }

    public function add_comment()
    {
        if ($this->input->method() === 'post') {
            $video_id = (int) $this->input->post('video_id', true);
            $comment = trim($this->input->post('comment', true));
            $user_id = $this->session->userdata('user_id');
            $user_name = $this->session->userdata('full_name') ?: 'Student';

            if ($video_id > 0 && !empty($comment)) {
                $this->db->insert('video_comments', [
                    'video_id'  => $video_id,
                    'user_id'   => $user_id,
                    'user_name' => $user_name,
                    'comment'   => $comment,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                $this->session->set_flashdata('project_ok', 'Comment posted successfully!');
            }
            redirect('learning/user/learning/' . $video_id);
        } else {
            redirect('learning/user/learning');
        }
    }

    public function webinars()
    {
        $user_id = $this->session->userdata('user_id');
        $user_data = $this->internship_user_model->get_by_id($user_id);

        $this->loadview('learning/user/webinars', [
            'page_title' => 'Upcoming Webinars',
            'user_data'  => $user_data
        ], 'projects/project_layout');
    }
}
