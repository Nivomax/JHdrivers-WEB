<?php

function demarrer_session()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}
