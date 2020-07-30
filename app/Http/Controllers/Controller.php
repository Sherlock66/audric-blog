<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Uploads multiple files from request into uploads/directory
     *
     * @param \Illuminate\Http\Request $request
     * @param string $key_validator
     * @param string $directory
     * @return array saved files paths
     */
    public function uploadMultipleFiles(Request $request, string $key_validator, string $directory, array $rules = [])
    {
        $savedFilePaths = [];
        $fileRules = array_merge(['file'], $rules);
        $fileRules = array_unique($fileRules);

        if ($files = $request->file($key_validator)) {
            foreach ($files as $file) {
                $this->validate($request->all(), [$key_validator . '[]' => $fileRules]);
                $extension = $file->getClientOriginalExtension();
                $relativeDestinationPath = 'uploads/' . $directory;
                $destinationPath = public_path($relativeDestinationPath);
                $safeName =  uniqid(substr($directory, 0, 15) . '.', true) . '.' . $extension;
                $file->move($destinationPath, $safeName);
                $savedFilePaths[] = $relativeDestinationPath . '/' . $safeName;
            }
        }

        return $savedFilePaths;
    }


    /**
     * Uploads file from request into uploads/directory
     *
     * @param \Illuminate\Http\Request $request
     * @param string $key_validator
     * @param string $directory
     * @param array $rules
     * @return array saved file path
     */
    public function uploadSingleFile(Request $request, string $key_validator, string $directory, array $rules = [])
    {
        $savedFilePath = null;
        $fileRules = array_merge(['file'], $rules);
        $fileRules = array_unique($fileRules);
        if ($file = $request->file($key_validator)) {
            $this->validate($request->all(), [$key_validator => $fileRules]);
            $extension = $file->getClientOriginalExtension();
            $relativeDestinationPath = 'uploads/' . $directory;
            $destinationPath = public_path($relativeDestinationPath);
            $safeName =  uniqid(substr($directory, 0, 15) . '.', true) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $savedFilePath = $relativeDestinationPath . '/' . $safeName;
        }

        return $savedFilePath;
    }
}
