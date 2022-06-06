<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
rules: {
    category: {
        required: true
    },
    image: {
        required: true,
        accept: "image/png,image/jpg,image/jpeg"
    }
}, messages: {
    category: {
        required: "* Please enter a category name"
    },
    image: {
        required: "* Please select a category image",
        accept: "* Please select a png, jpg or jpeg image"
    }
},