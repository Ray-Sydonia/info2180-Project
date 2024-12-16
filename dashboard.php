<div class="info">
    <div class="viewHead">
        <h1>Dashboard</h1>
        <button><a class="no_refresh" href="contact_form.php"><img src="img/add_black_24dp.svg" alt="">Add Contact</a></button>
    </div>
    <div class="table">
        <div>
            <div id="filter">
                <img src="img/filter_alt_black_24dp.svg" alt="">
                <h4>Filter By:</h4>
                <ul>
                    <li class="active"><a class="cont_types" id="all" href="dashboard_contacts.php">All</a></li>
                    <li><a class="cont_types" id="sales" href="dashboard_contacts.php">Sales Leads</a></li>
                    <li><a class="cont_types" id="support" href="dashboard_contacts.php">Support</a></li>
                    <li><a class="cont_types" id="assigned" href="dashboard_contacts.php">Assigned To Me</a></li>
                </ul>
            </div>
            <div id="homeResult">
                <?php include 'dashboard_contacts.php' ?>
            </div>
        </div>
    </div>
</div>