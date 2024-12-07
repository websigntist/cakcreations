<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class careers
 * @property Template $template
 * @property Breadcrumb $breadcrumb
 * @property Class Careers
 * @property M_careers $M_careers
 *
 */
class Careers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_careers');
    }

    /**
     * *****************************************************************************************************************
     * @method GET ALL CAREERS
     * *****************************************************************************************************************
     */
    public function index()
    {
        $where = '';
        $category = getUri(2);
        if (!empty($category)) {
            $where .= " AND career_cat.friendly_url='{$category}'";
        }

        $get_data['careers'] = $this->M_careers->getCareers('', $where);

        $this->template->set_site_title('Careers Opportunities');
        /*$this->template->meta('keywords', $get_data['posts']['category']->meta_keywords);
        $this->template->meta('description', $get_data['posts']['category']->meta_description);*/

        /* latest jobs for side bare*/
        $query = "SELECT * FROM careers WHERE status = 'Active' ORDER BY id DESC LIMIT 5";
        $data = $this->db->query($query);
        $get_data['latest_jobs'] = $data->result();

        $this->load->view('frontend/recruitment', $get_data);
    }

    /**
     * *****************************************************************************************************************
     * @method SINGLE CAREERS DETAIL
     * *****************************************************************************************************************
     */
    public function careers_detail()
    {
        $id = end(explode('-', getUri(2)));
        //$friendly_url = getUri(2);

        $get_data['career_detail'] = $this->M_careers->getCareers($id)['rows'][0];

        /* latest post for side bare*/
        $query = "SELECT * FROM careers WHERE status = 'Active' ORDER BY id DESC LIMIT 3";
        $data = $this->db->query($query);
        $get_data['latest_jobs'] = $data->result();

        $this->template->set_site_title($get_data['career_detail']->job_title);
        /*$this->template->meta('keywords', $get_data['careers_detail']->meta_keywords);
        $this->template->meta('description', $get_data['careers_detail']->meta_description);*/

        $this->load->view('frontend/recruitment_detail', $get_data);

    }


}