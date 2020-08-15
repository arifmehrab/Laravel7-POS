 @php 
  $prefix = Request::route()->getPrefix();
  $route  = Route::current()->getName();
 @endphp
 <!-- Page Wrapper -->
  <div id="wrapper">
    
 <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
          <img width="40" class="rounded-circle" src="{{ asset('assets/Backend/images/'. Auth::User()->profile) }}">
        </div>
        <div class="sidebar-brand-text mx-3">{{ Auth::User()->name }} <sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Employees
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
          <i class="far fa-user"></i>
          <span>Manage Employees</span>
        </a>
        <div id="collapse1" class="{{ ($prefix == '/users')?'collapse show':'collapse' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ ($route == 'users.view')?'active':'' }}" href="{{ route('users.view') }}">View All Employees</a>
            <a class="collapse-item {{ ($route == 'users.password.view')?'active':'' }}" href="{{ route('users.password.view') }}">Change Password</a>
          </div>
        </div>
      </li>

      <!-- Heading -->
      <div class="sidebar-heading">
        Supplier!
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
         <i class="fas fa-sign-in-alt"></i>
          <span>Manage Suppliers</span>
        </a>
        <div id="collapse2" class="{{ ($prefix == '/supplier')?'collapse show':'collapse' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ ($route == 'supplier.view')?'active':'' }}" href="{{ route('supplier.view') }}">View Suppliers</a>
          </div>
        </div>
      </li>

      <!-- Heading -->
      <div class="sidebar-heading">
        Customers!
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
          <i class="fas fa-street-view"></i>
          <span>Manage Customers</span>
        </a>
        <div id="collapse3" class="{{ ($prefix == '/customer')?'collapse show':'collapse' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ ($route == 'customer.view')?'active':'' }}" href="{{ route('customer.view') }}">View Customers</a>

            <a class="collapse-item {{ ($route == 'customer.credit')?'active':'' }}" href="{{ route('customer.credit') }}">Credit Customer</a>

            <a class="collapse-item {{ ($route == 'customer.paid.list')?'active':'' }}" href="{{ route('customer.paid.list') }}">Paid Customer</a>

            <a class="collapse-item {{ ($route == 'customer.wais.report')?'active':'' }}" href="{{ route('customer.wais.report') }}"> Customer Wais Report</a>

          </div>
        </div>
      </li>

      <!-- Heading -->
      <div class="sidebar-heading">
       Units!
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
          <i class="fas fa-sync"></i>
          <span>Manage Units</span>
        </a>
        <div id="collapse4" class="{{ ($prefix == '/unit')?'collapse show':'collapse' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ ($route == 'unit.view')?'active':'' }}" href="{{ route('unit.view') }}">View unit</a>
          </div>
        </div>
      </li>

      <!-- Heading -->
      <div class="sidebar-heading">
       Categories!
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
          <i class="fas fa-sliders-h"></i>
          <span>Manage Categories</span>
        </a>
        <div id="collapse5" class="{{ ($prefix == '/category')?'collapse show':'collapse' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ ($route == 'category.view')?'active':'' }}" href="{{ route('category.view') }}">View Categories</a>
          </div>
        </div>
      </li>

     <!-- Heading -->
      <div class="sidebar-heading">
       Products!
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
          <i class="fab fa-product-hunt"></i>
          <span>Manage Products</span>
        </a>
        <div id="collapse6" class="{{ ($prefix == '/products')?'collapse show':'collapse' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ ($route == 'products.view')?'active':'' }}" href="{{ route('products.view') }}">View Products</a>
          </div>
        </div>
      </li>

       <!-- Heading -->
      <div class="sidebar-heading">
       Purchase!
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
         <i class="fas fa-shopping-cart"></i>
          <span>Manage Purchase</span>
        </a>
        <div id="collapse7" class="{{ ($prefix == '/purchase')?'collapse show':'collapse' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ ($route == 'purchase.view')?'active':'' }}" href="{{ route('purchase.view') }}">View Purchase</a>

            <a class="collapse-item {{ ($route == 'purchase.pending.list')?'active':'' }}" href="{{ route('purchase.pending.list') }}">Purchase Pending List</a>

            <a class="collapse-item {{ ($route == 'purchase.report')?'active':'' }}" href="{{ route('purchase.report') }}">Purchase Report</a>
          </div>

        </div>
      </li>

      <!-- Heading -->
      <div class="sidebar-heading">
       Invoices!
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
         <i class="fas fa-file-invoice-dollar"></i>
          <span>Manage Invoice</span>
        </a>
        <div id="collapse8" class="{{ ($prefix == '/invoice')?'collapse show':'collapse' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ ($route == 'invoice.view')?'active':'' }}" href="{{ route('invoice.view') }}">View Invoices</a>

            <a class="collapse-item {{ ($route == 'invoice.pending.list')?'active':'' }}" href="{{ route('invoice.pending.list') }}">Invoices Pending List</a>

            <a class="collapse-item {{ ($route == 'invoice.print.list')?'active':'' }}" href="{{ route('invoice.print.list') }}">Print Invoice</a>

             <a class="collapse-item {{ ($route == 'invoice.daily')?'active':'' }}" href="{{ route('invoice.daily') }}">Daily Invoice</a>
          </div>

        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
         <i class="fab fa-stack-overflow"></i>
          <span>Manage Stock!</span>
        </a>
        <div id="collapse9" class="{{ ($prefix == '/stock')?'collapse show':'collapse' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ ($route == 'stock.report')?'active':'' }}" href="{{ route('stock.report') }}">Stock Report</a>

            <a class="collapse-item {{ ($route == 'stock.supplier.product.report')?'active':'' }}" href="{{ route('stock.supplier.product.report') }}">Supplier/Product Stock</a>
          </div>

        </div>
      </li>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->