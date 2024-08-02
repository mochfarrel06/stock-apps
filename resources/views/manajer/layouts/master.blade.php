<!DOCTYPE html>
<html lang="en">

<head>
    @include('manajer.layouts.head')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <x-master.wrapper>
        @include('manajer.layouts.sidebar')

        <!-- Content Wrapper -->
        <x-master.content-wrapper>

            <!-- Main Content -->
            <x-master.content>

                <!-- Topbar -->
                <x-navbar :routeActive="'manajer.profile.*'" :routeLink="'manajer.profile.index'" routeStore="{{ route('logout') }}" />
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->
            </x-master.content>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('manajer.layouts.footer')
            <!-- End of Footer -->
        </x-master.content-wrapper>
        <!-- End of Content Wrapper -->
    </x-master.wrapper>
    <!-- End of Page Wrapper -->

    @include('manajer.layouts.scripts')

</body>

</html>
