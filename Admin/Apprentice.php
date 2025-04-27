<?php
require_once __DIR__ . '../includes/auth_check.php';
validateAdminSession();

include 'Components/Header.php';
include 'Components/Sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/Apprentice.css">
    <!-- Add these to your <head> section -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <style>
        /* Modal styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(45, 45, 45, 0.55);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="PageMargin">
        <div class="ContainerBtm">
            <div class="ContainerBtmMargin">
                <div class="TitleStatus">
                    <svg width="36" height="36" fill="none" stroke="#316efa" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 20h5v-2a3 3 0 0 0-5.356-1.857"></path>
                        <path d="M7 20h10v-2a4.982 4.982 0 0 0-2.196-4.141A5.002 5.002 0 0 0 7 17.999v2Z"></path>
                        <path d="M7.356 16.143A3 3 0 0 0 2 18v2h5"></path>
                        <path d="M20.414 11.414a2 2 0 1 0-2.828-2.828 2 2 0 0 0 2.828 2.828Z"></path>
                        <path d="M15 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                        <path d="M6.414 11.414a2 2 0 1 0-2.828-2.828 2 2 0 0 0 2.828 2.828Z"></path>
                    </svg>
                    <span>Apprentice Status</span>
                </div>
                <div class="SearchbarContainer">
                    <div class="SearchBar">
                        <svg width="32" height="32" fill="none" stroke="#0866ff" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 17a7 7 0 1 0 0-14 7 7 0 0 0 0 14Z"></path>
                            <path d="m21 21-6-6"></path>
                        </svg>
                        <input type="text" placeholder="Search name..." id="SearchName" />
                    </div>
                    <!-- <button><span>Filter</span><svg width="32" height="32" fill="none" stroke="#0866ff"
                            stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="m3 4.5 7.2 8.409v6.313L13.8 21v-8.091L21 4.5H3Z"></path>
                        </svg></button> -->
                    <button id="Export"><span>Export</span><svg width="32" height="32" fill="none" stroke="#0866ff"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.5 16h-13v6h13v-6Z"></path>
                            <path d="M2 10h20v9h-3.491v-3H5.49v3H2v-9Z" clip-rule="evenodd"></path>
                            <path d="M19 2H5v8h14V2Z"></path>
                        </svg></button>
                </div>
                <div class="TableDisplayStatus">
                    <table class="apprentice-table">
                        <thead>
                            <tr>
                                <th></th> <!-- Profile image column (hidden header) -->
                                <th>Username</th>
                                <th>Password</th>
                                <th>Name</th>
                                <th>School</th>
                                <th>Completed Hours</th>
                                <th>Required Hours</th>
                                <th></th> <!-- Action column (hidden header) -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once __DIR__ . '/../db_connect.php';

                            $sql = "SELECT 
            p.Profile_Image_Path,
            CONCAT(p.First_Name, ' ', COALESCE(p.Middle_Initial + ' ', ''), p.Last_Name) AS Full_Name,
            p.School,
            s.Username,
            s.Password,
            s.Time_Complete,
            s.Required_Time,
            s.OJT_ID
        FROM OJT_TABLE_PERSONAL_DATA p
        JOIN OJT_TABLE_STATUS_CREDENTIAL s ON p.OJT_ID = s.OJT_ID";

                            $stmt = sqlsrv_query($conn, $sql);

                            if ($stmt === false) {
                                die(print_r(sqlsrv_errors(), true));
                            }

                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                echo "<tr class='clickable-row' data-ojtid='" . $row['OJT_ID'] . "'>
                <td class='profile-cell'>
                    <img src='" . htmlspecialchars($row['Profile_Image_Path']) . "' alt='Profile' class='profile-img'>
                </td>
                <td class='username-cell'>" . htmlspecialchars($row['Username']) . "</td>
                <td class='password-cell'>" . htmlspecialchars($row['Password']) . "</td>
                <td class='name-cell'>" . htmlspecialchars($row['Full_Name']) . "</td>
                <td class='school-cell'>" . htmlspecialchars($row['School']) . "</td>
                <td class='completed-cell'>" . $row['Time_Complete'] . "</td>
                <td class='required-cell'>" . $row['Required_Time'] . "</td>
                <td class='action-cell'>
                    <button class='action-btn' title='Status'>
                    </button>
                </td>
            </tr>";
                            }

                            sqlsrv_free_stmt($stmt);
                            sqlsrv_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="addInternModal">
        <button id="AddInternBtm" class="AddInternBtn">
            <svg width="100" height="100" fill="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.4 11.398v-5a1 1 0 0 0-2 0v5h-5a1 1 0 0 0 0 2h5v5a1 1 0 1 0 2 0v-5h5a1 1 0 1 0 0-2h-5Z">
                </path>
            </svg>
        </button>
    </div>

    <div id="AddInternModal" class="modal-overlay">
        <?php include 'Modals/Add_Intern_Modal.php'; ?>
    </div>

    <!-- Add this before the closing </body> tag -->
    <div id="exportPanel" class="export-panel" style="display: none;">
        <div class="export-options">
            <button id="exportPdf" class="export-btn">
                <svg width="24" height="24" fill="none" stroke="#0866ff" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-6l-2-2H6a2 2 0 0 0-2 2Z"></path>
                    <path d="M12 10v6"></path>
                    <path d="M9 13h6"></path>
                </svg>
                Export as PDF
            </button>
            <button id="exportExcel" class="export-btn">
                <svg width="24" height="24" fill="none" stroke="#0866ff" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-6l-2-2H6a2 2 0 0 0-2 2Z"></path>
                    <path d="M9.5 12.5 12 15l2.5-2.5"></path>
                    <path d="M12 10v5"></path>
                </svg>
                Export as Excel
            </button>
        </div>
    </div>

    <script>



        // Add this to your existing script section
        document.getElementById('Export').addEventListener('click', function (e) {
            e.stopPropagation();
            const exportPanel = document.getElementById('exportPanel');
            exportPanel.style.display = exportPanel.style.display === 'none' ? 'block' : 'none';
        });

        // Close export panel when clicking outside
        document.addEventListener('click', function (e) {
            if (!e.target.closest('#exportPanel') && !e.target.closest('#Export')) {
                document.getElementById('exportPanel').style.display = 'none';
            }
        });

        // PDF Export
        document.getElementById('exportPdf').addEventListener('click', function () {
            exportTable('pdf');
            document.getElementById('exportPanel').style.display = 'none';
        });

        // Excel Export
        document.getElementById('exportExcel').addEventListener('click', function () {
            exportTable('excel');
            document.getElementById('exportPanel').style.display = 'none';
        });

        function exportTable(type) {
            // Get table data
            const rows = Array.from(document.querySelectorAll('.apprentice-table tbody tr'));
            const headers = ['Username', 'Password', 'Name', 'School', 'Completed Hours', 'Required Hours'];

            // Prepare data
            const data = rows.map(row => {
                return {
                    username: row.querySelector('.username-cell').textContent,
                    password: row.querySelector('.password-cell').textContent,
                    name: row.querySelector('.name-cell').textContent,
                    school: row.querySelector('.school-cell').textContent,
                    completed: row.querySelector('.completed-cell').textContent,
                    required: row.querySelector('.required-cell').textContent
                };
            });

            if (type === 'pdf') {
                exportToPdf(headers, data);
            } else {
                exportToExcel(headers, data);
            }
        }

        function exportToPdf(headers, data) {
            // Create a new jsPDF instance
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Add title
            doc.setFontSize(18);
            doc.text('Apprentice Report', 14, 20);

            // Prepare table data
            const tableData = data.map(item => [
                item.username,
                item.password,
                item.name,
                item.school,
                item.completed,
                item.required
            ]);

            // Add table
            doc.autoTable({
                head: [headers],
                body: tableData,
                startY: 30,
                styles: {
                    fontSize: 10,
                    cellPadding: 3
                },
                headStyles: {
                    fillColor: [13, 110, 253],
                    textColor: 255
                }
            });

            // Save the PDF
            doc.save('apprentice_report.pdf');
        }

        function exportToExcel(headers, data) {
            // Create a workbook
            const wb = XLSX.utils.book_new();

            // Prepare worksheet data
            const wsData = [
                headers,
                ...data.map(item => [
                    item.username,
                    item.password,
                    item.name,
                    item.school,
                    item.completed,
                    item.required
                ])
            ];

            // Create worksheet
            const ws = XLSX.utils.aoa_to_sheet(wsData);

            // Add worksheet to workbook
            XLSX.utils.book_append_sheet(wb, ws, "Apprentices");

            // Save the Excel file
            XLSX.writeFile(wb, "apprentice_report.xlsx");
        }

        // Update the search functionality in your script section
        document.getElementById('SearchName').addEventListener('input', function (e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.apprentice-table tbody tr');
            const rowsArray = Array.from(rows);

            if (!searchTerm) {
                // If search is empty, restore original order
                const tbody = document.querySelector('.apprentice-table tbody');
                tbody.innerHTML = '';
                rowsArray.forEach(row => tbody.appendChild(row));
                return;
            }

            // Sort rows based on combined relevance of name and school
            rowsArray.sort((a, b) => {
                const nameA = a.querySelector('.name-cell').textContent.toLowerCase();
                const nameB = b.querySelector('.name-cell').textContent.toLowerCase();
                const schoolA = a.querySelector('.school-cell').textContent.toLowerCase();
                const schoolB = b.querySelector('.school-cell').textContent.toLowerCase();

                // Calculate combined match scores (60% name, 40% school)
                const scoreA = (calculateMatchScore(nameA, searchTerm) * 1) +
                    (calculateMatchScore(schoolA, searchTerm) * 0.4);
                const scoreB = (calculateMatchScore(nameB, searchTerm) * 0.6) +
                    (calculateMatchScore(schoolB, searchTerm) * 0.4);

                // Highlight matches in both name and school
                highlightText(a.querySelector('.name-cell'), searchTerm);
                highlightText(a.querySelector('.school-cell'), searchTerm);
                highlightText(b.querySelector('.name-cell'), searchTerm);
                highlightText(b.querySelector('.school-cell'), searchTerm);

                return scoreB - scoreA;
            });

            // Re-append sorted rows
            const tbody = document.querySelector('.apprentice-table tbody');
            tbody.innerHTML = '';
            rowsArray.forEach(row => tbody.appendChild(row));
        });

        // Keep the existing calculateMatchScore function
        function calculateMatchScore(text, searchTerm) {
            if (!searchTerm) return 0;

            // Exact match gets highest score
            if (text === searchTerm) return 100;

            // Starts with search term
            if (text.startsWith(searchTerm)) return 75;

            // Contains search term
            if (text.includes(searchTerm)) return 50;

            // Partial matches (letters in order)
            let searchIndex = 0;
            for (let i = 0; i < text.length; i++) {
                if (text[i] === searchTerm[searchIndex]) {
                    searchIndex++;
                    if (searchIndex === searchTerm.length) break;
                }
            }

            // Return score based on how much of the search term was found
            return (searchIndex / searchTerm.length) * 40;
        }

        // Keep the existing highlightText function
        function highlightText(element, searchTerm) {
            if (!searchTerm) {
                element.innerHTML = element.textContent;
                return;
            }
            const text = element.textContent;
            const innerHTML = text.replace(
                new RegExp(searchTerm, 'gi'),
                match => `<span class="highlight-match">${match}</span>`
            );
            element.innerHTML = innerHTML;
        }

        // Get the modal and link elements
        const modal = document.getElementById('AddInternModal');
        const AddInternBtm = document.getElementById('AddInternBtm');
        const closeModal = document.querySelector('.close');
        const submitButton = document.getElementById('submitAddIntern');

        // Show modal when AddInternBtm is clicked
        AddInternBtm.addEventListener('click', function (e) {
            e.preventDefault();
            modal.style.display = 'flex';  // Show the modal
        });

        // Close modal when X is clicked
        closeModal.addEventListener('click', function () {
            modal.style.display = 'none'; // Hide the modal
        });

        // Close modal when clicking outside the modal content
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
        document.querySelector('#AddInternModal form')?.addEventListener('submit', function (e) {
            // Let the form submit normally (no e.preventDefault())
            // Optionally, show a loading spinner
        });


        // Make rows clickable to navigate to Intern_Information.php
        document.querySelectorAll('.clickable-row').forEach(row => {
            row.addEventListener('click', function (e) {
                // Don't navigate if clicking the action button
                if (!e.target.closest('.action-btn')) {
                    const ojtId = this.getAttribute('data-ojtid');
                    // Store the OJT_ID in sessionStorage
                    sessionStorage.setItem('selectedOjtId', ojtId);
                    window.location.href = `Intern_Information.php?ojt_id=${ojtId}`;
                }
            });
        });
    </script>
</body>

</html>