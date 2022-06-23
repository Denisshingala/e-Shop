<?php

session_start();
session_unset();
session_destroy();

header("location:/online_shopping/online_shopping");