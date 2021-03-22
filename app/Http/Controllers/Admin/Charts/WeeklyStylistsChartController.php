<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Models\Stylist;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Carbon\Carbon;

/**
 * Class WeeklyStylistsChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WeeklyStylistsChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        // MANDATORY. Set the labels for the dataset points
        $labels = [];
        for ($days_backwards = 30; $days_backwards >= 0; $days_backwards--) {
            if ($days_backwards == 1) {
            }
            $labels[] = $days_backwards.' days ago';
        }
        $this->chart->labels($labels);

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/weekly-stylists'));

        // OPTIONAL
        $this->chart->minimalist(false);
        $this->chart->displayLegend(true);
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return json
     */
     public function data()
     {
         for ($days_backwards = 30; $days_backwards >= 0; $days_backwards--) {
             // Could also be an array_push if using an array rather than a collection.
             $stylists[] = Stylist::whereDate('created_at', Carbon::now()->subDays($days_backwards))
                 ->count();
         }

         $this->chart->dataset('Stylists', 'line', $stylists)
             ->color('rgba(255, 193, 7, 0.4)')
             ->backgroundColor('rgba(255, 193, 7, 0.4)');

     }
}
