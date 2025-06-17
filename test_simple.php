<?php

use Tests\TestCase;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    public function test_dashboard_admin_can_load()
    {
        // Test apakah dashboard controller bisa dijalankan tanpa error
        $controller = new DashboardController();

        try {
            $response = $controller->index();
            echo "Dashboard controller executed successfully!\n";
            return true;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
            return false;
        }
    }
}

// Run test
$test = new DashboardTest('test_dashboard_admin_can_load');
$test->test_dashboard_admin_can_load();
