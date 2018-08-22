<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function setFilterValue($filter) {

    if (isset($_GET['searchPerson'][$filter])) {
        echo $_GET['searchPerson'][$filter];
    }
    if (isset($_GET['searchUser'][$filter])) {
        echo $_GET['searchUser'][$filter];
    }
    if (isset($_GET['searchCompany'][$filter])) {
        echo $_GET['searchCompany'][$filter];
    }
}
