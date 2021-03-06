<?php
/**
 *   @file Stats
 *   @brief
 *
 *   @author Jamie Little (little9)
 *   @date Aug 2016
 *   
 *  Limiter -- //WHERE FROM_UNIXTIME(stats.date) BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()";
 */

namespace SubjectsPlus\Control;

class Stats
{
    private $db;

    public function __construct(Querier $db) {
	$this->db = $db; 
    }

    public function getTotalViews() {
	$query = "SELECT count(*) as 'total_views_last_month' from stats";
	return $this->db->query($query);
    }

    public function getTotalViewsPerGuide() {
	$query = "SELECT page_title, count(*) as num, subject_short_form from stats WHERE event_type = 'view' group by page_title order by count(*) desc";
	return $this->db->query($query);
    }
    public function getTopExternalLinks() {
	$query = "SELECT count(*) as num, link_url as 'total_link_clicks', subject_short_form from stats  
	WHERE event_type = 'link' AND link_url NOT LIKE '#%' group by link_url order by count(*) desc";
	return $this->db->query($query);
    }
    public function  getTopTabsPerGuide() {
	$query = "SELECT count(*) as num ,tab_name, subject_short_form from stats  
	WHERE event_type = 'tab_click' group by subject_short_form order by count(*) desc";
	return $this->db->query($query);
    }
}
