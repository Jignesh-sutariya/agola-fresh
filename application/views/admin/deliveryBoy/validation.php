<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
rules: {
    fullname: {
        required: true
    },
    mobile: {
        required: true,
        minlength: 10,
        maxlength: 10,
        digits: true
    },
    address: {
        required: true
    },
    password: {
        required: true,
        minlength: 6
    },
    c_password: {
        equalTo: "#password"
    }
}, messages: {
    fullname: {
        required: "* Please enter a fullname"
    },
    mobile: {
        required: "* Please enter a mobile",
        minlength: "* Please enter a valid mobile",
        maxlength: "* Please enter a valid mobile",
        digits: "* Please enter a valid mobile"
    },
    address: {
        required: "* Please enter a address"
    },
    password: {
        required: "* Please provide a password",
        minlength: "* Your password must be at least 6 characters long"
    },
    c_password: {
        equalTo: "* confirm password should be same as password"
    }
},