<?php

/**
 * This file is part of samsonasik/ci4-album.
 *
 * (c) 2020 Abdul Malik Ikhsan <samsonasik@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace AlbumTest\Unit\Domain\Track;

use Album\Domain\Track\Track;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class TrackTest extends TestCase
{
    public function testFillGetAttributes(): void
    {
        $track = new Track([
            'id'       => 1,
            'album_id' => 1,
            'title'    => 'sebuah kisah klasik',
            'author'   => 'eross chandra',
        ]);

        $this->assertSame(1, $track->id);
        $this->assertSame(1, $track->album_id);
        $this->assertSame('Sebuah Kisah Klasik', $track->title);
        $this->assertSame('Eross Chandra', $track->author);
    }
}
