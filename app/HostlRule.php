<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class HostlRule extends Model
{
    /**
     * this method returns a rule
     */
    public function getRule($id)
    {
        $rule = HostlRule::find($id);
        return $rule;
    }
   /**
     * this method returns hostel rules
     */
    public function getHostelRule($id)
    {
        $rule = HostlRule::where('hostel_id', $id)->get();
        return $rule;
    }

    /**
     * this function stores hostel rule
     */
    public function storeRule(Request $request)
    {
        
        $rule = new HostlRule();
        $rule->hostel_id = $request->hostelRules['hostelId'];
        $rule->rule_1 = $request->hostelRules['rule1'];
        $rule->rule_2 = $request->hostelRules['rule2'];
        $rule->rule_3 = $request->hostelRules['rule3'];
        $rule->rule_4 = $request->hostelRules['rule4'];
        $rule->rule_5 = $request->hostelRules['rule5'];
        $rule->rule_6 = $request->hostelRules['rule6'];
        $rule->rule_7 = $request->hostelRules['rule7'];
        $rule->rule_8 = $request->hostelRules['rule8'];
        $rule->rule_9 = $request->hostelRules['rule9'];
        $rule->rule_10 = $request->hostelRules['rule10'];
        $rule->rule_11 = $request->hostelRules['rule11'];
        $rule->rule_12 = $request->hostelRules['rule12'];
        $rule->rule_13 = $request->hostelRules['rule13'];
        $rule->rule_14 = $request->hostelRules['rule14'];
        $rule->rule_15 = $request->hostelRules['rule15'];
        $rule->save();
    }

    /**
     * this function updates hostel rules
     */
    public function updateRule(Request $request)
    {
        $rule = HostlRule::find($request->hostelRules['ruleId']);
        $rule->rule_1 = $request->hostelRules['rule1'];
        $rule->rule_2 = $request->hostelRules['rule2'];
        $rule->rule_3 = $request->hostelRules['rule3'];
        $rule->rule_4 = $request->hostelRules['rule4'];
        $rule->rule_5 = $request->hostelRules['rule5'];
        $rule->rule_6 = $request->hostelRules['rule6'];
        $rule->rule_7 = $request->hostelRules['rule7'];
        $rule->rule_8 = $request->hostelRules['rule8'];
        $rule->rule_9 = $request->hostelRules['rule9'];
        $rule->rule_10 = $request->hostelRules['rule10'];
        $rule->rule_11 = $request->hostelRules['rule11'];
        $rule->rule_12 = $request->hostelRules['rule12'];
        $rule->rule_13 = $request->hostelRules['rule13'];
        $rule->rule_14 = $request->hostelRules['rule14'];
        $rule->rule_15 = $request->hostelRules['rule15'];
        $rule->save();
        return $rule->hostel_id;
    }
}
