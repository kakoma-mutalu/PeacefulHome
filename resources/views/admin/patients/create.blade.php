@extends('layouts.admin')
@section('admin')
<div class="mb-4"><h1>Register patient</h1><p class="text-muted">Create the master patient record.</p></div>
<div class="card p-4"><form method="POST" action="{{ route('admin.patients.store') }}">@csrf
<div class="row g-3">
<div class="col-md-6"><label>First name</label><input name="first_name" class="form-control" required></div><div class="col-md-6"><label>Last name</label><input name="last_name" class="form-control" required></div>
<div class="col-md-4"><label>Date of birth</label><input name="date_of_birth" type="date" class="form-control"></div><div class="col-md-4"><label>Gender</label><select name="gender" class="form-select"><option value="">Select</option><option>Male</option><option>Female</option><option>Other</option></select></div><div class="col-md-4"><label>Phone</label><input name="phone" class="form-control" required></div>
<div class="col-md-6"><label>Email</label><input name="email" type="email" class="form-control"></div><div class="col-md-6"><label>Address</label><input name="address" class="form-control"></div>
<div class="col-md-6"><label>Emergency contact</label><input name="emergency_contact_name" class="form-control"></div><div class="col-md-6"><label>Emergency phone</label><input name="emergency_contact_phone" class="form-control"></div>
<div class="col-md-4"><label>Status</label><select name="status" class="form-select"><option value="active">Active</option><option value="inactive">Inactive</option><option value="discharged">Discharged</option></select></div>
<div class="col-12"><label>Notes</label><textarea name="notes" class="form-control" rows="4"></textarea></div>
<div class="col-12"><button class="btn btn-green">Save patient</button></div>
</div></form></div>
@endsection
