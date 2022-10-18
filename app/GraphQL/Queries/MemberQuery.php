<?php
namespace App\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use App\Models\Member;
use App\Models\Helper;
use Log;
use Auth;

class MemberQuery extends Query
{
    protected $attributes = [
        'name' => 'MemberQuery query',
    ];

    public function type(): Type
    {
        return GraphQL::type('MemberType');
    }
    public function resolve($root, $args)
    {
        try {
            if (Auth::guard('member')->check()) {
                $member = new Member();
                $member_data = $member->getLoggedInMember();
                return $member_data;
            }
        } catch (Exception $e) {
            Log::debug($e->getMessage());
        }
    }
}

?>
