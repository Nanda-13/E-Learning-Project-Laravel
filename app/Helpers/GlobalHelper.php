<?php

use App\Models\Category;
use App\Models\SubCategory;

/* Global Use in Category  */
if (!function_exists('getCategories')) {
    function getCategories() {

        return Category::get();
    }
}

/* Global Use in Sub Category  */
if (!function_exists('getSubCategories')) {
    function getSubCategories() {

        return SubCategory::get();
    }
}
