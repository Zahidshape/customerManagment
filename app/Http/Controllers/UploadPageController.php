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
    public function showDashboard()
    {

        $totalFiles = Upload::count();
        $uniquecustomers = customer::count();
        $duplicatecustomers = CustomerUploadMap::count();

        $data = ['active' => 'dashboard'];
        return view('dashboard', $data, compact('totalFiles','uniquecustomers','duplicatecustomers'));
    }
    public function showUploadForm()
    {
        $data = ['active' => 'upload'];
        return view('upload', $data);
    }

    
    public function getAllCustomers() {
        
        $customers = customer::paginate(15);
        $status = ['active' => 'customerlist'];
        $data = compact('customers');
        return view ('customerlist',$status)->with($data);
    }
    
    public function getAllfiles()
    {
        $uploads = Upload::paginate(15);
        $totalFiles = Upload::count();
        
        $data = ['active' => 'files'];
        return view('files',$data, compact('uploads'));
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

         //  Live - Insert Data by command   
            $logFilePath = '/home/techsoul/public_html/cms.tech-soul.com/storage/logs/import_customers.log';
            $command = '/opt/cpanel/ea-php82/root/usr/bin/php /home/techsoul/public_html/cms.tech-soul.com/artisan import:customers ' . $upload->id . ' "' . $fullFilePath . '" >> ' . $logFilePath . ' 2>&1 &';
            pclose(popen($command, 'r'));

            // Local - Insert Data by command
            // $command = 'start /B php C:\Users\BUTT\Desktop\cms_clone\customerManagment\artisan import:customers ' . $upload->id . ' "' . $fullFilePath . '" > NUL 2>&1';
            // pclose(popen($command, 'r'));


            // ProcessFileJob::dispatch($fullFilePath, $upload->id);
            //  Excel::import(new ImportCustomers($upload->id), $fullFilePath); 
                return redirect()->back()->with('success', 'File uploaded successfully and is being processed.');
        //}

        
        return redirect()->back()->with('error', 'File upload failed.');
    }


    public function downloadUniqueCustomers(Request $request)
    {
        $uploadId =$request->get('uploadId');

        $upload = Upload::where('id', $uploadId)->first();

        if (!$upload) {
            return;
        }

        $fileName = explode('.', $upload->file_name)[0];

        $customers = Customer::where('upload_id', $uploadId)->get(); 
        
        if ($customers->isEmpty()) {
            
            return redirect()->back()->with('error', 'No unique customers available for download.');
        }

        $response = new StreamedResponse(function () use ($customers) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['first_name', 'last_name','phone_number','email','address','postcode','county']);
           
            foreach ($customers as $customer) {
                fputcsv($handle, [
                    $customer->first_name,
                    $customer->last_name,
                    $customer->phone_number,
                    $customer->email,
                    $customer->address,
                    $customer->postcode,
                    $customer->county,

                ]);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$fileName.'"_unique_customers.csv"',
        ]);

        return $response;
    }

    public function downloadDuplicateCustomers(Request $request)
    {
        $uploadId = $request->get('uploadId');

        $upload = Upload::where('id', $uploadId)->first();

        if (!$upload) {
            return;
        }

        $fileName = explode('.', $upload->file_name)[0];


        $duplicateCustomerIds = CustomerUploadMap::where('is_duplicate', true)
            ->where('upload_id', $uploadId)
            ->pluck('customer_id');

        $customers = Customer::whereIn('id', $duplicateCustomerIds)->get();

        if ($customers->isEmpty()) {
            
            return redirect()->back()->with('message', 'No Duplicate customers available for download.');
        }

        $source = $customers[0]->upload->source;

        $response = new StreamedResponse(function () use ($customers, $source) {
            $handle = fopen('php://output', 'w');
           
            fputcsv($handle,['first_name', 'last_name','phone_number','email','address','postcode','county']);
             
            foreach ($customers as $customer) {
                fputcsv($handle, [
                    $customer->first_name,
                    $customer->last_name,
                    $customer->phone_number,
                    $customer->email,
                    $customer->address,
                    $customer->postcode,
                    $customer->county,
                ]);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$fileName.'"_duplicate_customers.csv"',
        ]);

        return $response;
    }
}
    



    


