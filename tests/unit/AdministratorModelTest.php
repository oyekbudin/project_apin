<?php 
namespace Tests\Unit;

use App\Models\AdministratorModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class AdministratorModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;
    public function setUp(): void
{
    parent::setUp();

    // Muat fungsi helper CodeIgniter
    require_once APPPATH . 'Common.php';
}


    public function testgetTotalAdministrator()
    {
        $model = new AdministratorModel();

        $total = $model->getTotalAdministrator();
        $this->assertEquals(2, $total);
    }
}

