<?php

namespace Deployer;

import(__DIR__ . '/deployer/host.yml');
import(__DIR__ . '/deployer/deploy.php');
import(__DIR__ . '/deployer/dp_pull.php');
import(__DIR__ . '/deployer/media_pull.php');

set('default_timeout', 1200);
set('local_magento_path', '.');
