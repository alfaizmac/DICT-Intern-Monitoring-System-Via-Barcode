<div class="body">
    <div class="ModalContainer">
        <form id="credentialForm" method="POST" action="/DICT-MANAGEMENT/handler/update_credential_handler.php">
            <div class="FirstContainer">
                <div class="head">
                    <div class="title2">
                        <h1>Update Intern</h1>
                    </div>
                    <label for="" id="OJT_ID"></label>
                    <div class="ContainerClose">
                        <svg class="close" width="32" height="32" fill="none" stroke="#222" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="m18.75 5.25-13.5 13.5"></path>
                            <path d="M18.75 18.75 5.25 5.25"></path>
                        </svg>
                    </div>
                </div>
                <div class="SecondContainer">
                    <label for="Username">Username</label>
                    <div class="InputContainer"><input type="text" name="Username" id="Username" required></div>
                </div>
                <div class="SecondContainer">
                    <label for="Password">Password</label>
                    <div class="InputContainer">
                        <input type="text" id="Password" name="Password" required>
                    </div>
                </div>
                <div class="SecondContainer">
                    <label for="Required_Time">Required Minutes</label>
                    <div class="InputHourContainer">
                        <input type="text" name="Required_Time" id="Required_Time" required>
                    </div>
                </div>
                <div class="ButtonContainer">
                    <button type="button" id="submit-btn" onclick="submitForm()">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function submitForm() {
        const form = document.getElementById('credentialForm');
        const formData = new FormData(form);

        // Add OJT_ID to the form data
        const ojtId = document.getElementById('OJT_ID').textContent;
        formData.append('ojt_id', ojtId);

        fetch(form.action, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating credentials');
            });
    }
</script>


<style>
    * {
        margin: 0px;
        padding: 0px;
    }

    .body {
        background-color: #f5f5f5;
        font-family: "Segoe UI History", Segoe UI, Tahoma, Geneva, Verdana, sans-serif;
        width: 100%;
        height: 100vh;
        background-color: rgb(60, 60, 60, 0.4);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .head {
        display: flex;
        width: 100%;
        height: auto;
    }

    .ModalContainer {
        width: auto;
        height: auto;
        border-radius: 8px;
        background: #fff;

    }

    .SecondContainer input {
        width: 100%;
        height: 100%;
        border-radius: 12px;
        border: none;
        font-size: 16px;
        font-weight: 400;
        padding-left: 20px;
    }

    .SecondContainer input:focus {
        outline: none;
        box-shadow: 0px 0px 4px 4px rgba(0, 0, 0, 0.1);
    }

    .FirstContainer {
        display: flex;
        flex-direction: column;
        justify-content: start;
        align-items: center;
        width: 100%;
        height: auto;
        /* padding: 35px 0px 0px 45px; */
        gap: 20px;
    }

    .SecondContainer {
        display: flex;
        flex-direction: row;
        width: 100%;
        height: 63px;
        margin-left: 80px;
        align-items: center;
    }

    .SecondContainer label {
        width: 137px;
        font-size: 16px;
    }

    .SecondContainer .InputContainer {
        width: 100%;
        height: 100%;
        display: flex;
        background-color: #fbfbfb;
        border-radius: 12px;
        border: solid 1px #9e9e9e;
        font-size: 24px;
        font-weight: 600;
        margin-left: 70px;
        margin-right: 90px;
    }

    .SecondContainer .InputHourContainer {
        width: 90px;
        height: 100%;
        display: flex;
        background-color: #fbfbfb;
        border-radius: 12px;
        border: solid 1px #9e9e9e;
        font-size: 24px;
        font-weight: 600;
        margin-left: 12px;
        margin-right: 90px;
    }

    .ButtonContainer {
        display: flex;
        width: 100%;
        height: auto;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .FirstContainer .ButtonContainer button {
        display: flex;
        width: 150px;
        height: 60px;
        font-weight: 500;
        background: #428aff;
        align-items: center;
        justify-content: center;
        color: #fff;
        border-radius: 12px;
        border: none;
        font-size: 15px;
    }

    .FirstContainer .ButtonContainer button:hover {
        background: #649fff;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        font-weight: 600;
    }

    .title2 {
        display: flex;
        justify-content: start;
        width: 100%;
        height: auto;
        margin-bottom: 30px;
        margin-top: 30px;
    }

    .ContainerClose {
        display: flex;
        justify-content: start;
        align-items: start;
        height: 100%;
        width: auto;
    }

    .close {
        display: flex;
        margin: 10px 10px 0 0;
        transition: all 0.3s ease-in-out;
        cursor: pointer;
    }

    .close:hover {
        stroke: #428aff;
    }

    .title2 h1 {
        display: flex;
        font-size: 24px;
        font-weight: Medium;
        color: #1b1b1b;
        padding-left: 40px;
    }
</style>