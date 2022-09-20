<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class UserFilter extends ApiFilter
{
    protected $safeParms = [
        'id'   => ['eq'],
        'name' => ['eq'],
        'email' => ['eq'],
        'password' => ['eq'],
        'purchase_code' => ['eq'],
        'url_site' => ['eq'],
        'email_verified_at' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'created_at' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'updated_at' => ['eq', 'lt', 'gt', 'lte', 'gte'],
    ];

    protected $columnMap = [
        'purchase_code' => 'purchase_code',
        'url_site' => 'url_site',
        'email_verified_at' => 'email_verified_at',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
    ];

    protected $operatorMap = [
        'eq'    =>  '=',
        'lt'    =>  '<',
        'lte'    =>  '<=',
        'gt'    =>  '>',
        'gte'    =>  '>=',
    ];
}
