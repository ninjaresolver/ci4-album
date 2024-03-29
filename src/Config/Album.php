<?php

/**
 * This file is part of samsonasik/ci4-album.
 *
 * (c) 2020 Abdul Malik Ikhsan <samsonasik@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Album\Config;

use CodeIgniter\Config\BaseConfig;

final class Album extends BaseConfig
{
    /**
     * @var int
     */
    public $paginationPerPage = 10;
}
