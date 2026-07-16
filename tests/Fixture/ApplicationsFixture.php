<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApplicationsFixture
 */
class ApplicationsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'members_id' => 1,
                'advertisement_id' => 1,
                'status' => 1,
                'created' => '2026-06-17 14:59:47',
                'modified' => '2026-06-17 14:59:47',
            ],
        ];
        parent::init();
    }
}
