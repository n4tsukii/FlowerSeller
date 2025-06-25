@extends('layouts.admin')
@section('title','Edit Contact')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contact Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Contact Page</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
    
      <div class="card">
 
        <div class="card-header">
            <div class="row">
                <div class="col-12 text-right">
                    <a href="{{ route('admin.contact.index') }}" class="btn btn-sm btn-info">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Contacts
                    </a>
                </div>
            </div>
        </div>
    
        <div class="card-body">
        <form action="{{ route('admin.contact.update', $contact->id) }}" method="post">
                @csrf
                @method('put')
                <h1 class="text-center">Edit Contact</h1>
                <div class="container">
                    <div class="row g-3">
                    <div class="col-md-12 mb-3">
                            <label for="user_id" class="form-label">User ID</label>
                            <input
                                type="text"
                                id="user_id"
                                class="form-control"
                                name="user_id"
                                value="{{ old('user_id', $contact->user_id) }}"
                            />
                            @error('user_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input
                                type="text"
                                id="name"
                                class="form-control"
                                name="name"
                                value="{{ old('name', $contact->name) }}"
                            />
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="text"
                                id="email"
                                class="form-control"
                                name="email"
                                value="{{ old('email', $contact->email) }}"
                            />
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        
                        
                        <div class="col-md-12 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input
                                type="text"
                                id="phone"
                                class="form-control"
                                name="phone"
                                value="{{ old('phone', $contact->phone) }}"
                            /> 
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                          
                        <div class="col-md-12 mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input
                                type="text"
                                id="title"
                                class="form-control"
                                name="title"
                                value="{{ old('title', $contact->title) }}"
                            /> 
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                          
                        <div class="col-md-12 mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" id="content" col="155 "rows="5" class="form-control">{{ old('content', $contact->content) }}</textarea>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="replay_id" class="form-label">Replay ID</label>
                            <input
                                type="number"
                                id="replay_id"
                                class="form-control"
                                name="replay_id"
                                value="{{ old('replay_id', $contact->replay_id) }}"
                            /> 
                            @error('replay_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                                
                        <div class="col-md-12 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ $contact->status == 1 ? 'selected' : '' }}>Show</option>
                                <option value="0" {{ $contact->status == 0 ? 'selected' : '' }}>Hide</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <button
                                class="btn btn-primary w-100"
                                type="submit"
                            >
                                Update Contact
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </section>
  </div>
@endsection
