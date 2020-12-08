@extends('layouts.app');
<div class="row">
<div class="input-group control-group increment" >
    <input type="file" name="filename[]" class="form-control">
    <div class="input-group-btn"> 
      <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
    </div>
  </div>
  <div class="clone hide">
    <div class="control-group input-group" style="margin-top:10px">
      <input type="file" name="filename[]" class="form-control">
      <div class="input-group-btn"> 
        <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
      </div>
    </div>
  </div>
</div>
        