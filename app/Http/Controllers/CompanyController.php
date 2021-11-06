<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['companies' => Company::paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $company = new Company();
        return $this->createOrUpdate($company, $request, false);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        if ($company) {
            return response()->json(['company' => $company]);
        } else {
            return response()->json(['message' => 'Not Found']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $company = Company::find($id);
        if ($company) return $this->createOrUpdate($company, $request, true);
        return response()->json(['message' => 'Record not found']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if ($company) {
            $company->delete();
            return response()->json(['message' => 'Record Deleted Successfully', 'companies' => Company::paginate(10)]);
        } else {
            return response()->json(['message' => 'Record not found']);
        }
    }

    private function createOrUpdate(Company $company, CompanyRequest $request, bool $is_update_function)
    {
        $message = '';
        $company->fill($request->all());
        if ($request->hasFile('logo_url')) {
            try {
                if ($is_update_function && $company->logo_url != null) {
                    unlink($company->logo_url);
                }
                $path = $request->file('logo_url')->store(
                    'logo_avatars', 'public'
                );
                $company->logo_url = $path;
            } catch (\Exception $exception) {
                return response()->json(['message' => $exception->getMessage()]);
            }
        }
        if ($is_update_function) {
            $company->update();
            $message = 'Updated Successfully';
        } else {
            $company->save();
            $message = 'Created Successfully';

        }
        return response()->json(
            [
                'message' => $message,
                'companies' => Company::paginate(10)
            ]);
        return response()->json(['companies' => Company::paginate(10)]);
    }

    public function getCompanyListForEmployee()
    {
        return Company::all();
    }
}
