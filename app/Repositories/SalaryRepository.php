<?php
namespace App\Repositories;

use App\Models\Salary;
use App\Models\User;
use App\Repositories\Interfaces\ISalaryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SalaryRepository implements ISalaryRepository
{
    /**
     * Returns a collection of salaries with the base salary, user id and commission rates.
     * The commission rates are calculated from the tasks that are finished and have an end date within the last month.
     * The salaries are joined with the users table and left joined with the tasks table.
     * The salaries are grouped by their id and ordered by the user type.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return Salary::select('salaries.id', 'base_salary', 'salaries.user_id', DB::raw('IFNULL(SUM(tasks.commission_rates), 0) as commission_rates'))
            ->join('users', 'users.id', '=', 'salaries.user_id')
            ->leftJoin('tasks', function ($join) {
                $join->on('tasks.user_id', '=', 'salaries.user_id')
                    ->where('tasks.finished', '=', 1)
                    ->where('tasks.ends_at', '>=', now()->subMonth());
            })
            ->groupBy('salaries.id')
            ->orderBy('users.user_type')
            ->get();
    }

    /**
     * This method updates the base salary of a salary by its ID.
     *
     * @param Request $request The request object containing the salary ID and the new base salary
     * @return JsonResponse A JSON response indicating the success of the update
     */
    public function update(Request $request): JsonResponse
    {
        $salary = Salary::find($request->input('pk'));
        $salary->base_salary = $request->input('value');
        $salary->save();
        return response()->json(['success' => true]);
    }

    /**
     * This method returns a collection of users who do not have a salary.
     *
     * @param Request $request The request object containing the optional user type filter
     * @return Collection The collection of users without a salary
     */
    public function getUsersWithoutSalary(Request $request): Collection
    {
        $user_type = $request->input('user_type');

        $query =  User::doesntHave('salary');

        if (!empty($user_type)) {
            $query->where('users.user_type', $user_type);
        }
        return $query->get();
    }

    /**
     * This method creates a new salary for a user by their ID.
     *
     * @param Request $request The request object containing the salary and the user ID
     * @return RedirectResponse A redirect response to the salaries page with a status message
     * @throws ValidationException If the salary is not a valid integer or is negative
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(['integer','min:0']);
        Salary::create(['base_salary'=>$request->input('salary'), 'user_id'=>$request->input('userId')]);
        return Redirect::route('manager.salaries.index')->with('status', 'salary-added');
    }}
