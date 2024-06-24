<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Exception\RuntimeException;
use Symfony\Component\Process\Exception\ProcessTimedOutException;
use Symfony\Component\Process\Process;

class RealTimeDetectionController extends Controller
{
    public function index()
    {
        return view('detectionIndex');
    }

    public function realtimeDetection()
    {
        // Increase the maximum execution time to 1200 seconds (20 minutes)
        set_time_limit(1200);

        // Define the Python interpreter and script path
        $python = 'C:/Users/Acer/AppData/Local/Programs/Python/Python312/python.exe';
        $script = 'C:/Users/Acer/Documents/UTeM/Sem 6/BITP3353 MULTIMEDIA DATABASE/Project/SignLanguagePython/hand-gesture-recognition-mediapipe-main/app.py';
        $workingDirectory = 'C:/Users/Acer/Documents/UTeM/Sem 6/BITP3353 MULTIMEDIA DATABASE/Project/SignLanguagePython/hand-gesture-recognition-mediapipe-main';

        try {
            // Create the process instance
            $process = new Process([$python, $script]);
            $process->setWorkingDirectory($workingDirectory);

            // Set a timeout for the process (1200 seconds)
            $process->setTimeout(1200);

            // Run the process
            $process->run();

            // Executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            // Return the view dectection index
            //return view('detectionIndex');
            return $process->getOutput();
        } catch (ProcessTimedOutException $e) {
            // Return the view with a custom timeout error message
            return view('detectionIndex')->with('message', 'The execution time of 20 minutes exceeded');
        } catch (ProcessFailedException | RuntimeException $e) {
            // Return the view with a custom error message for other exceptions
            return view('detectionIndex')->with('message', 'Your laptop does not support the real time detection');
        }

        
    }

}