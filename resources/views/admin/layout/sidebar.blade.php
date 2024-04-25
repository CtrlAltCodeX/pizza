<!--**********************************
        Sidebar start
    ***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{route('admin.dashboard')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-034-filter"></i>
                    <span class="nav-text">Food</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.category')}}">Category</a></li>
                    <li><a href="{{route('admin.items')}}">Items</a></li>
                    <li><a href="{{route('admin.ingredients')}}">Ingredients</a></li>
                </ul>
            </li>

            <li>
                <a href="{{route('admin.orders')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-013-checkmark"></i>
                    <span class="nav-text">Orders</span>
                </a>
            </li>

            <!-- <li>
                <a href="{{route('admin.customers')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-050-info"></i>
                    <span class="nav-text">Customers</span>
                </a>
            </li> -->
            <li>
                <a href="{{route('admin.users')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-050-info"></i>
                    <span class="nav-text">Registration</span>
                </a>
            </li>
            <li>
                <a href="{{route('shops.index')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-050-info"></i>
                    <span class="nav-text">Shop</span>
                </a>
            </li>
        </ul>
        {{-- <div class="plus-box">--}}
        {{-- <img src="images/plus.png" alt="">--}}
        {{-- <h5 class="fs-18 font-w700">Add Menus</h5>--}}
        {{-- <p class="fs-14 font-w400">Manage your food <br>and beverages menus<i class="fas fa-arrow-right ms-3"></i></p>--}}
        {{-- </div>--}}
        <div class="copyright">
            <p><strong>PizzaOnline Restaurant Admin</strong> © {{date('Y')}} All Rights Reserved</p>
            <p class="fs-12">Made with <span class="heart"></span> by TshrXD</p>
        </div>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->