<?php
namespace User;

function isUsefulForCreate($user) : bool {
    $result = true;
    if (
        $user->email    === NULL ||
        $user->name     === NULL ||
        $user->id       === NULL ||
        $user->hash     === NULL
    )
    { $result = false; }

    return $result;
}

function isEmail($email) : bool {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

function isRoot ($perm) : bool {
    $result = false;

    if ($perm === Permission::Root) {
        $result = true;
    }

    return $result;
}

function isMember($perm) : bool {
    $result = false;

    if ($perm === Permission::Member) {
        $result = true;
    }

    return $result;
}

function isGuest ($perm) : bool {
    $result = false;

    if ($perm === Permission::Guest) {
        $result = true;
    }

    return $result;
}

function matchHash ($hash0,$hash1) : bool {
    return ($hash0 === $hash1);
}
