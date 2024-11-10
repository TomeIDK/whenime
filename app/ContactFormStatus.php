<?php

namespace App;

enum ContactFormStatus: string
{
    case Unread = 'UNREAD';
    case Read = 'READ';
    case Solved = 'SOLVED';
}
