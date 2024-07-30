<!DOCTYPE html>
<html lang="en">

<head>
    @include('gudang.layouts.head')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <x-master.wrapper>
        @include('gudang.layouts.sidebar')
        <!-- Content Wrapper -->
        <x-master.content-wrapper>
            <!-- Main Content -->
            <x-master.content>
                <!-- Topbar -->
                <x-navbar :routeActive="'gudang.profile.*'" :routeLink="'gudang.profile.index'" />
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->
            </x-master.content>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('gudang.layouts.footer')
            <!-- End of Footer -->

        </x-master.content-wrapper>
        <!-- End of Content Wrapper -->
    </x-master.wrapper>
    <!-- End of Page Wrapper -->

    @include('gudang.layouts.scripts')

</body>

</html>
