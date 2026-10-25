<?php

abstract class Events_Provider {
    abstract public function send(User $user, Events_Info $info);
}
