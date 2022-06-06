<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

rules: {
        fname: {
            required: true
        },
        lname: {
            required: true
        },
        image: {
            accept: "image/png,image/jpg,image/jpeg"
        },
        password: {
            required: true,
            minlength: 6
        },
        confirm_password: {
            equalTo: "#password"
        }
    },
messages: {
        fname: {
            required: "* Please select a first name"
        },
        lname: {
            required: "* Please select a last name"
        },
        image: {
            accept: "* Invalid image"
        },
        password: {
            required: "* Please provide a password",
            minlength: "* Your password must be at least 6 characters long"
        },
        confirm_password: {
            equalTo: "* confirm password should be same as password"
        }
    },