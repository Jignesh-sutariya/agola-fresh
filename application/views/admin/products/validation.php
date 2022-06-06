<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
rules: {
    category_id: {
        required: true
    },
    image: {
        required: true,
        accept: "image/png,image/jpg,image/jpeg"
    },
    qty_type: {
        required: true
    },
    eng_name: {
        required: true
    },
    guj_name: {
        required: true
    },
    price: {
        required: true,
        number: true
    },
    min_qty: {
        required: true,
        number: true
    }
}, messages: {
    category_id: {
        required: "* Please select a category name"
    },
    image: {
        required: "* Please select a product image",
        accept: "* Please select a png, jpg or jpeg image"
    },
    qty_type: {
        required: "* Please select a quantity type"
    },
    eng_name: {
        required: "* Please enter a product name(english)"
    },
    guj_name: {
        required: "* Please enter a product name(gujarati)"
    },
    price: {
        required: "* Please enter a product price",
        required: "* Please enter a product price"
    },
    min_qty: {
        required: "* Please enter a product minimum quantity",
        required: "* Please enter a product minimum quantity"
    }
},