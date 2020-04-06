<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 5.4.2020 г.
 * Time: 21:55
 */

namespace Src\Services;


class CategoryService
{
    function getAllCategories()
    {
        global $wpdb;
        try {
            $query = 'Select C.id, C.name FROM wp_categories AS C';
            $stmt = $wpdb->prepare($query);
            $categories = [];
            if ($result = $wpdb->get_results($stmt)) {
                foreach ($result as $row) {
                    $categories[] = [
                        "category_id" => $row->id,
                        "category_name" => $row->name,
                    ];
                }
            }

            return $categories;
        } catch (\Exception $ex) {
            return false;
        }
    }
}