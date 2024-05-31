<?php

$redis = new Redis();

$redis->connect(DB_HOST, DB_PORT);

if (DB_AUTH_ENABLE) $redis->auth('your_redis_password');

echo "Connection to Redis server successfully!";


?>