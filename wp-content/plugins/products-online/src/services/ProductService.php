<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 5.4.2020 г.
 * Time: 21:55
 */

namespace Src\Services;


class ProductService
{
    function getAllProducts($offset, $length)
    {
        global $wpdb;
        try {
            $sql = 'SELECT C.name AS category_name,
                        P.id, P.name, P.description, P.price, P.category_id, P.created
                        FROM wp_products AS P
                          JOIN wp_categories AS C
                            ON P.category_id = C.id
                        GROUP BY p.id
                        LIMIT %d, %d';
            $stmt = $wpdb->prepare($sql, [$offset, $length]);

            $products = [];
            if ($result = $wpdb->get_results($stmt)) {
                foreach ($result as $row) {
                    $products[] = [
                        "id" => $row->id,
                        "name" => $row->name,
                        "description" => html_entity_decode($row->description),
                        "price" => $row->price,
                        "category_id" => $row->category_id,
                        "category_name" => $row->category_name
                    ];
                }
            }

            return $products;
        } catch (\Exception $ex) {
            return false;
        }
    }

    function getProductById($id)
    {
        global $wpdb;
        try {
            $query = "SELECT
                        C.name AS category_name, P.id, P.name, P.description, P.price, P.category_id, P.created
                    FROM wp_products AS P
                        LEFT JOIN
                            wp_categories AS C
                                ON P.category_id = C.id
                    WHERE P.id = %d";

            $sqlData = $wpdb->prepare($query, [$id]);
            $result = $wpdb->get_row($sqlData, ARRAY_A);

            return $result;
        } catch (\Exception $ex) {
            return false;
        }
    }

    function deleteProductById($id)
    {
        global $wpdb;
        try {
            $result = $wpdb->query(
                $wpdb->prepare(
                    "DELETE FROM wp_products WHERE id = %d",
                    $id
                )
            );

            return $result;
        } catch (\Exception $ex) {
            return false;
        }
    }

    function editProduct(array $params)
    {
        global $wpdb;
        $table = $wpdb->prefix . 'products';

        try {
            return $wpdb->update( $table, $params, ['id' => $params['id']]);
        } catch (\Exception $ex) {
            return false;
        }
    }

}