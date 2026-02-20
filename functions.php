<?php

function getContacts() {
    $contactsFile = __DIR__ . "/contacts.json";
    $contactsJson = file_get_contents($contactsFile);
    return $contactsJson ? json_decode($contactsJson, true) : [];
}

function filterContacts($contacts, $query) {
    if ($query === "") {
        return $contacts;
    }
    return array_values(array_filter($contacts, function ($contact) use ($query) {
        return stripos($contact["name"], $query) !== false;
    }));
}

function applyAjaxDelay() {
    sleep(1);
}
