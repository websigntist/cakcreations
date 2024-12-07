<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class posts
 * @property Template $template
 * @property Breadcrumb $breadcrumb
 * @property Class Posts
 * @property M_posts $M_posts
 *
 */
class Posts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_posts');
    }

    /**
     * *****************************************************************************************************************
     * @method GET ALL POSTS
     * *****************************************************************************************************************
     */
    public function posts()
    {
        $where = '';
        $category = getUri(2);
        if (!empty($category)) {
            $where .= " AND blog_cat.friendly_url='{$category}'";
        }

        $get_data['posts'] = $this->M_posts->getposts('', $where);

        $this->template->set_site_title($get_data['posts']['blog_cat']->title);
        $this->template->meta('keywords', $get_data['posts']['blog_cat']->meta_keywords);
        $this->template->meta('description', $get_data['posts']['blog_cat']->meta_description);

        /* latest post for side bare*/
        $query = "SELECT * FROM blog_post WHERE status = 'Published' ORDER BY id DESC LIMIT 3";
        $data = $this->db->query($query);
        $get_data['latest_post'] = $data->result();

        /* archive post */
        $query = "SELECT YEAR(created) AS `year` FROM blog_post GROUP BY YEAR(created) ORDER BY year DESC";
        $data = $this->db->query($query);
        $get_data['archive_post'] = $data->result();

        /* blog tags */
        $query = "SELECT * FROM blog_tags WHERE status = 'Active' ORDER BY tags ASC";
        $data = $this->db->query($query);
        $get_data['blog_tags'] = $data->result();

        $this->load->view('frontend/posts', $get_data);
    }

    /**
     * *****************************************************************************************************************
     * @method SINGLE POST DETAIL
     * *****************************************************************************************************************
     */
    public function blog_detail()
    {
        $id = end(explode('-', getUri(2)));

        $get_data['post_detail'] = $this->M_posts->getposts($id)['rows'][0];

        /* latest post for side bare*/
        $query = "SELECT * FROM blog_post WHERE status = 'Published' ORDER BY id DESC LIMIT 3";
        $data = $this->db->query($query);
        $get_data['latest_post'] = $data->result();

        /* archive post */
        $query = "SELECT YEAR(created) AS `year` FROM blog_post GROUP BY YEAR(created) ORDER BY year DESC";
        $data = $this->db->query($query);
        $get_data['archive_post'] = $data->result();

        /* GET ALL TAGS */
        $query = "SELECT
              blog_tags.tags
            , blog_tags.ordering
            , blog_tags.status
        FROM blog_tags
            INNER JOIN blog_tags_post ON (blog_tags.id = blog_tags_post.tag_id)
            WHERE blog_tags.status = 'Active' AND blog_tags_post.post_id = {$id} GROUP BY blog_tags.tags ORDER BY blog_tags.ordering ASC";
        $data = $this->db->query($query);
        $get_data['blog_tags'] = $data->result();

        $this->template->set_site_title($get_data['post_detail']->meta_title);
        $this->template->meta('keywords', $get_data['post_detail']->meta_keywords);
        $this->template->meta('description', $get_data['post_detail']->meta_description);

        $this->load->view('frontend/post_detail', $get_data);

    }


}