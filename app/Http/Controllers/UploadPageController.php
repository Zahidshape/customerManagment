<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerUploadMap; 
use App\Imports\ImportCustomers;
use App\Models\Upload;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

use App\Jobs\ProcessFileJob;

class UploadPageController extends Controller
{
    public function showUploadForm()
    {
        $uploads = Upload::all();
        return view('upload', compact('uploads'));
    }

    public function uploadFile(Request $request)
    {
        
        //if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
             
            $upload = new Upload();
            $upload->file_name = $fileName;
            $upload->source = $request->input('source');
            $upload->save();
            
           

            $fullFilePath = storage_path('app/public/uploads/' . $fileName);


            ProcessFileJob::dispatch($fullFilePath, $upload->id);
           
            //    Excel::import(new ImportCustomers($upload->id), $fullFilePath); 
                return redirect()->back()->with('success', 'File uploaded successfully and is being processed.');
        //}

        
        return redirect()->back()->with('error', 'File upload failed.');
    }


    public function downloadUniqueCustomers()
    {
        $customers = Customer::all();  

        $response = new StreamedResponse(function () use ($customers) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['first_name', 'last_name','phone_number','email']);
           
            foreach ($customers as $customer) {
                fputcsv($handle, [
                    $customer->first_name,
                    $customer->last_name,
                    $customer->phone_number,
                    $customer->email,
                ]);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="unique_customers.csv"',
        ]);

        return $response;
    }

    public function downloadDuplicateCustomers()
    {
         
        $duplicateCustomerIds = CustomerUploadMap::where('is_duplicate', true)->pluck('customer_id');

       
        

        $customers = Customer::whereIn('id', $duplicateCustomerIds)->get();   

        $response = new StreamedResponse(function () use ($customers) {
            $handle = fopen('php://output', 'w');
           
            fputcsv($handle, ['first_name', 'last_name','phone_number','email']);
             
            foreach ($customers as $customer) {
                fputcsv($handle, [
                    $customer->first_name,
                    $customer->last_name,
                    $customer->phone_number,
                    $customer->email
                ]);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="duplicate_customers.csv"',
        ]);

        return $response;
    }
}
    


