<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemSettingsController extends Controller
{
    /**
     * Show the system settings form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve existing settings from the database or configuration
        $settings = [
            // Example settings
            'site_name' => config('app.name'),
            'maintenance_mode' => config('app.maintenance'),
        ];

        return view('system.settings', compact('settings'));
    }

    /**
     * Update the system settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'site_name' => 'required|string|max:255',
            'maintenance_mode' => 'required|boolean',
        ]);

        // Update settings in the database or configuration
        // For example, updating the .env file:
        $this->updateEnv([
            'APP_NAME' => $request->input('site_name'),
            'APP_MAINTENANCE' => $request->input('maintenance_mode'),
        ]);

        return redirect()->route('system.settings')
                         ->with('success', 'Settings updated successfully.');
    }

    /**
     * Update the .env file with new settings.
     *
     * @param  array  $data
     * @return void
     */
    protected function updateEnv(array $data)
    {
        $envPath = base_path('.env');
        $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));

        foreach ($data as $key => $value) {
            $contentArray->transform(function ($item) use ($key, $value) {
                return Str::contains($item, $key) ? "$key=$value" : $item;
            });
        }

        $content = implode(PHP_EOL, $contentArray->toArray());
        file_put_contents($envPath, $content);
    }
}
