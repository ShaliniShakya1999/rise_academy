<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!class_exists("My_Controller"))
    include_once APPPATH . 'core/My_Controller.php';

/**
 * Layout â€” public website pages (landing, about, templates, etc).
 * Auth is in Auth.php controller. Resume CRUD is in Resume.php.
 */
class Layout extends My_Controller
{
    public function index()
    {
        // Standalone landing page with its own header/footer
        $this->load->view('Website/landing_standalone', ['page_title' => 'Internmo â€” Welcome']);
    }

    public function home()
    {
        $this->loadview('Website/index', ['page_title' => 'Build resumes that get you hired']);
    }

    public function about()
    {
        $this->loadview('Website/about', ['page_title' => 'About']);
    }

    public function templates()
    {
        $this->load->model('template_model');
        $this->loadview('Website/templates', [
            'page_title' => 'Templates',
            'templates'  => $this->template_model->all_active(),
        ]);
    }

    public function privacy()
    {
        $this->loadview('Website/privacy', ['page_title' => 'Privacy']);
    }

    public function jobs()
    {
        $this->load->model('job_model');
        $filters = [
            'q'               => trim((string) $this->input->get('q', true)),
            'category'        => trim((string) $this->input->get('category', true)),
            'employment_type' => trim((string) $this->input->get('type', true)),
        ];
        $saved_job_ids = [];
        if ($this->session->userdata('logged_in')) {
            $this->load->model('wishlist_model');
            $saved_job_ids = $this->wishlist_model->ids_for_user((int) $this->session->userdata('user_id'), 'job');
        }

        $this->loadview('Website/jobs', [
            'page_title'     => 'Jobs',
            'jobs'           => $this->job_model->active(50, $filters),
            'categories'     => $this->job_model->categories(),
            'filters'        => $filters,
            'total'          => $this->job_model->count_all(),
            'saved_job_ids'  => $saved_job_ids,
        ]);
    }

    public function internship()
    {
        $this->load->model('internship_model');
        $filters = [
            'q'         => trim((string) $this->input->get('q', true)),
            'category'  => trim((string) $this->input->get('category', true)),
            'is_remote' => $this->input->get('remote') === '1' ? 1 : 0,
        ];
        $saved_internship_ids = [];
        if ($this->session->userdata('logged_in')) {
            $this->load->model('wishlist_model');
            $saved_internship_ids = $this->wishlist_model->ids_for_user((int) $this->session->userdata('user_id'), 'internship');
        }

        $this->loadview('Website/internship', [
            'page_title'            => 'Internship',
            'internships'           => $this->internship_model->active(50, $filters),
            'categories'            => $this->internship_model->categories(),
            'filters'               => $filters,
            'total'                 => $this->internship_model->count_all(),
            'saved_internship_ids'  => $saved_internship_ids,
        ]);
    }

    public function resume_checker()
    {
        $this->load->model('job_model');
        $this->loadview('Website/resume_checker', [
            'page_title'  => 'AI ATS Resume Checker',
            'top_jobs'    => $this->job_model->active(4),
            'page_assets' => [
                'css' => 'assets/website/css/resume-checker.css?v=2',
                'js'  => 'assets/website/js/resume-checker.js?v=2',
            ],
        ]);
    }

    public function project_submission()
    {
        redirect('projects/login');
    }

    public function contact()
    {
        $this->loadview('Website/contact', ['page_title' => 'Contact Us']);
    }

    public function courses($slug = '')
    {
        $courses = [
            'full-stack-development' => [
                'title' => 'Full Stack Development',
                'subtitle' => 'Frontend and Backend Development',
                'description' => 'Master both frontend design and backend database systems. Learn to build modern, production-ready web applications from scratch using React, Node.js, Express, and SQL databases.',
                'icon' => 'fa-solid fa-laptop-code',
                'duration' => '5-8 Months',
                'format' => 'Online',
                'emi' => '₹2,950 /month*',
                'color_theme' => 'amber',
                'gradient' => 'from-amber-600 to-orange-600',
                'curriculum' => [
                    'Frontend Fundamentals (HTML5, CSS3, ES6 Javascript)',
                    'Modern Frontend Frameworks (React.js, Tailwind CSS)',
                    'Backend API Development (Node.js, Express.js)',
                    'Database Management (MySQL, PostgreSQL, MongoDB)',
                    'Production Deployment & Git Collaboration'
                ],
                'highlights' => [
                    'Professional certificate upon completion',
                    '10,000+ coding challenges & exercises',
                    '5+ real-world portfolio projects',
                    'Unlimited mock interviews with industry experts'
                ]
            ],
            'app-development' => [
                'title' => 'App Development',
                'subtitle' => 'iOS and Android Development',
                'description' => 'Build high-performance native and cross-platform mobile apps for iOS and Android. Master Flutter, React Native, and native architecture principles.',
                'icon' => 'fa-solid fa-mobile-screen-button',
                'duration' => '6 Months',
                'format' => 'Online',
                'emi' => '₹3,200 /month*',
                'color_theme' => 'indigo',
                'gradient' => 'from-indigo-600 to-violet-600',
                'curriculum' => [
                    'Mobile UI Design Principles & Layouts',
                    'Cross-Platform Development with Flutter & Dart',
                    'State Management & Native Device Integration',
                    'Local Databases & API Services integration',
                    'App Store & Google Play Store Submission'
                ],
                'highlights' => [
                    'Build 3 fully functional apps from scratch',
                    '100% Placement assistance support',
                    'Live project reviews from senior mobile engineers',
                    'Access to mobile developer network'
                ]
            ],
            'cyber-security' => [
                'title' => 'Cyber Security',
                'subtitle' => 'Information Security & Ethical Hacking',
                'description' => 'Secure applications, networks, and databases from modern digital threats. Learn system auditing, penetration testing, threat hunting, and security protocols.',
                'icon' => 'fa-solid fa-shield-halved',
                'duration' => '6 Months',
                'format' => 'Online / Hybrid',
                'emi' => '₹3,500 /month*',
                'color_theme' => 'emerald',
                'gradient' => 'from-emerald-600 to-teal-600',
                'curriculum' => [
                    'Fundamentals of Network & System Security',
                    'Ethical Hacking & Vulnerability Assessment',
                    'Application Security & Secure Coding standards',
                    'Incident Response & Digital Forensics',
                    'Security Compliance (ISO 27001, GDPR)'
                ],
                'highlights' => [
                    'Hands-on lab training on actual attack models',
                    'Preparatory classes for CEH Certification',
                    'Direct mentoring from Chief Security Officers',
                    '100% simulated sandbox environments'
                ]
            ],
            'devops' => [
                'title' => 'DevOps',
                'subtitle' => 'Cloud Infrastructure & Continuous Delivery',
                'description' => 'Bridge the gap between development and operations. Automate infrastructure deployment, cloud scalability, CI/CD pipelines, and containerization.',
                'icon' => 'fa-solid fa-server',
                'duration' => '5 Months',
                'format' => 'Online',
                'emi' => '₹3,100 /month*',
                'color_theme' => 'sky',
                'gradient' => 'from-sky-500 to-indigo-600',
                'curriculum' => [
                    'Linux Administration & Shell Scripting',
                    'Infrastructure as Code (IaC) with Terraform',
                    'Containerization & Orchestration (Docker & Kubernetes)',
                    'Continuous Integration/Continuous Deployment (CI/CD)',
                    'Cloud Operations on AWS and Google Cloud Platform'
                ],
                'highlights' => [
                    'Architect a production cloud deployment pipeline',
                    'Includes preparing for AWS DevOps certification',
                    'Direct training from top Site Reliability Engineers',
                    '24/7 cloud lab credits included'
                ]
            ],
            'artificial-intelligence' => [
                'title' => 'Artificial Intelligence (AI)',
                'subtitle' => 'Machine Learning & Generative AI Systems',
                'description' => 'Unlocking the power of cognitive computing. Build predictive models, fine-tune Generative AI models, and design intelligent agents using PyTorch and Hugging Face.',
                'icon' => 'fa-solid fa-brain',
                'duration' => '8 Months',
                'format' => 'Online',
                'emi' => '₹4,500 /month*',
                'color_theme' => 'purple',
                'gradient' => 'from-purple-600 to-fuchsia-600',
                'curriculum' => [
                    'Python for AI, Linear Algebra & Probability',
                    'Machine Learning Algorithms & Model Evaluation',
                    'Deep Learning & Neural Networks with PyTorch',
                    'Natural Language Processing & Large Language Models',
                    'Building Generative AI Applications & Agents'
                ],
                'highlights' => [
                    '80+ Hours of intensive live lectures',
                    '10+ real-world AI and LLM integration projects',
                    'Learn from MAANG AI experts & researchers',
                    'Compute credits on cloud GPUs'
                ]
            ],
            'java-developer' => [
                'title' => 'Java Developer',
                'subtitle' => 'Enterprise Application Development',
                'description' => 'Become an expert Java Software Engineer. Master Object-Oriented Programming, Spring Boot architectures, microservices, and high-volume database connectivity.',
                'icon' => 'fa-brands fa-java',
                'duration' => '5 Months',
                'format' => 'Online',
                'emi' => '₹2,800 /month*',
                'color_theme' => 'red',
                'gradient' => 'from-red-600 to-orange-600',
                'curriculum' => [
                    'Core Java & Object-Oriented Programming (OOP)',
                    'Data Structures and Algorithms in Java',
                    'Spring Framework & Spring Boot microservices',
                    'Hibernate/JPA for Database Persistence',
                    'System Architecture, Design Patterns, and Testing'
                ],
                'highlights' => [
                    'Build scale-resilient enterprise microservices',
                    'Master SQL, JDBC, and Hibernate database setups',
                    'Prepare for Java developer technical rounds',
                    'Placement support with top IT consultancy firms'
                ]
            ],
            'ui-ux' => [
                'title' => 'UI/UX',
                'subtitle' => 'Product Design & User Experience',
                'description' => 'Design high-fidelity user interfaces and user-centered products. Learn user research, low-fidelity wireframing, high-fidelity prototyping, and UI branding.',
                'icon' => 'fa-solid fa-palette',
                'duration' => '4 Months',
                'format' => 'Online',
                'emi' => '₹2,500 /month*',
                'color_theme' => 'pink',
                'gradient' => 'from-pink-500 to-rose-500',
                'curriculum' => [
                    'User Research Methodologies & Persona Creation',
                    'Information Architecture & User Flow Mapping',
                    'Wireframing and Prototyping inside Figma',
                    'Design Systems, Color Theory, and Typography',
                    'Usability Testing & Design Handoff protocols'
                ],
                'highlights' => [
                    'Create a full professional Behance/Dribbble portfolio',
                    'Master industry-leading Figma prototyping features',
                    'Real product feedback sessions with Lead Designers',
                    'Mock interviews & design critique sessions'
                ]
            ],
            'data-science' => [
                'title' => 'Data Science',
                'subtitle' => 'Advanced Data Analytics & Modeling',
                'description' => 'Harness the power of big data. Extract actionable business intelligence, perform statistical modeling, and deploy predictive pipelines using Python and R.',
                'icon' => 'fa-solid fa-chart-line',
                'duration' => '8 Months',
                'format' => 'Online',
                'emi' => '₹3,900 /month*',
                'color_theme' => 'violet',
                'gradient' => 'from-violet-600 to-purple-600',
                'curriculum' => [
                    'Advanced Statistical Methods & NumPy/Pandas',
                    'Data Visualization (Matplotlib, Seaborn, Tableau)',
                    'Predictive Modeling & Statistical Inference',
                    'Big Data Analytics (Spark, Hadoop, Hive)',
                    'Data Science Deployment Pipelines & Storytelling'
                ],
                'highlights' => [
                    'Solve 15+ complex business analytics cases',
                    'Interact with Senior Data Scientists in weekly AMA sessions',
                    'Master data cleaning & predictive pipeline validation',
                    'Get hired by high-growth startups & data consultancies'
                ]
            ],
            'data-analyst' => [
                'title' => 'Data Analyst',
                'subtitle' => 'Business Intelligence & Reporting',
                'description' => 'Turn raw data into business decisions. Master SQL databases, Excel analytics, Tableau dashboards, and dashboard reporting pipelines.',
                'icon' => 'fa-solid fa-magnifying-glass-chart',
                'duration' => '4 Months',
                'format' => 'Online',
                'emi' => '₹2,600 /month*',
                'color_theme' => 'teal',
                'gradient' => 'from-teal-500 to-emerald-600',
                'curriculum' => [
                    'Advanced Excel Formulas & Interactive Dashboards',
                    'Relational Databases & SQL Queries',
                    'Data Visualization & Dashboards using Power BI / Tableau',
                    'Python for Basic Data Wrangling & Operations',
                    'Executive Business Reporting and Storytelling'
                ],
                'highlights' => [
                    'Build 4 fully-featured interactive business dashboards',
                    'Mock interviews focused on SQL and analytics rounds',
                    '100% Placement assistance with Fortune 500 partners',
                    'Curated resume review for Data Analyst jobs'
                ]
            ],
            'digital-marketing' => [
                'title' => 'Digital Marketing',
                'subtitle' => 'Performance Marketing & Branding',
                'description' => 'Acquire customers and build strong brands online. Master SEO, Paid Search/Social Ads, Email Marketing, Content Strategies, and web analytics.',
                'icon' => 'fa-solid fa-bullhorn',
                'duration' => '4 Months',
                'format' => 'Online',
                'emi' => '₹2,200 /month*',
                'color_theme' => 'orange',
                'gradient' => 'from-orange-500 to-red-500',
                'curriculum' => [
                    'Search Engine Optimization (On-Page, Off-Page, Technical)',
                    'Paid Advertising (Google Search/Display, Facebook, Instagram)',
                    'Content Marketing, Social Media Strategy, and Copywriting',
                    'Email Automation, Lead Nurturing, and CRM Platforms',
                    'Google Analytics 4, Tag Manager, & ROI Measurement'
                ],
                'highlights' => [
                    'Live campaign budget matching for actual testing',
                    'Get certified in Google Search Ads and Analytics',
                    'Taught by growth hackers & digital agency founders',
                    'Comprehensive marketing portfolio with live campaigns'
                ]
            ]
        ];

        // If no slug is specified, render the generic courses list or redirect to home page
        if (empty($slug)) {
            $this->loadview('Website/courses', [
                'page_title' => 'Our Courses',
                'courses' => $courses
            ]);
            return;
        }

        // Check if the requested course exists
        if (!isset($courses[$slug])) {
            show_404();
            return;
        }

        // Render the beautiful dynamic course details page
        $this->loadview('Website/course_details', [
            'page_title' => $courses[$slug]['title'],
            'course' => $courses[$slug],
            'all_courses' => $courses // helpful for a sidebar or fast selector
        ]);
    }

    /**
     * Form validation callback — empty OK, else must be valid URL.
     */
    public function _optional_url($str)
    {
        $str = trim((string) $str);
        if ($str === '') {
            return true;
        }
        if (filter_var($str, FILTER_VALIDATE_URL)) {
            return true;
        }
        $this->form_validation->set_message('_optional_url', 'The {field} must be a valid URL (include https://).');
        return false;
    }
}




