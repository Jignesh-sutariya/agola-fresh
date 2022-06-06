<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
rules: {
    title: {
        required: true
    },
    sub_title: {
        required: true
    },
    image: {
        required: true,
        accept: "image/png,image/jpg,image/jpeg"
    }
}, messages: {
    title: {
        required: "* Please enter a title name"
    },
    sub_title: {
        required: "* Please enter a sub title name"
    },
    image: {
        required: "* Please select a category image",
        accept: "* Please select a png, jpg or jpeg image"
    }
},