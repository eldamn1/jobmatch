<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MembersFixture
 */
class MembersFixture extends TestFixture
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
                'user_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'address' => 'Lorem ipsum dolor sit amet',
                'phone_number' => 'Lorem ipsum dolor ',
                'resume' => 'Lorem ipsum dolor sit amet',
                'resume_dir' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2026-06-20 13:18:58',
                'modified' => '2026-06-20 13:18:58',
            ],
        ];
        parent::init();
    }
}
