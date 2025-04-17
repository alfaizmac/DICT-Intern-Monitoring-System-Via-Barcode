<div class="body">
    <div class="MainContainer">
        <div class="margin">
            <div class="TopContainer">
                <div class="ForgotPassword"><Span>Forgot Password</Span> </div>
                <svg class="close" width="20" height="20" fill="none" stroke="#222" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="m18.75 5.25-13.5 13.5"></path>
                    <path d="M18.75 18.75 5.25 5.25"></path>
                </svg>
            </div>
            <p>Please enter your username below. A notification <br>
                will be sent to the administrator to assist you <br>
                with resetting your password. If you need further <br>
                assistance, please contact the administrator <br>
                directly.</p>

            <div class="InputContainerModal"><input type="text" placeholder="Username..."></div>
            <button>Submit</button>
        </div>
    </div>
</div>

<style>
    * {
        padding: 0;
        margin: 0;
        font-family: 'internal', sans-serif;
    }

    .body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100%;
    }

    .MainContainer {
        display: flex;
        flex-direction: column;
        justify-content: start;
        align-items: center;
        height: 350px;
        width: 368px;
        background-color: rgba(251, 251, 251, 1);
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .margin {
        margin: 20px;
    }

    .TopContainer {
        display: flex;
        justify-content: start;
        align-items: start;
        width: 100%;
    }

    .close {
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .close:hover {
        stroke: #428aff;
        cursor: pointer;
    }

    .ForgotPassword {
        display: flex;
        justify-content: start;
        align-items: center;
        width: 100%;
        font-size: 24px;
        font-weight: 600;
        color: rgba(42, 94, 212, 1);
    }

    .MainContainer p {
        font-size: 15px;
        font-weight: 400;
        color: rgba(26, 26, 26, 1) margin-top: 10px;
        margin-top: 20px;
    }

    .InputContainerModal {
        display: flex;
        justify-content: start;
        align-items: center;
        background: #fff;
        border: 1px solid rgba(49, 110, 250, 1);
        border-radius: 12px;
        width: 100%;
        height: 60px;
        margin-top: 30px;
    }

    .InputContainerModal input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        padding-left: 20px;
        font-size: 16px;
        font-weight: 400;
        color: rgba(26, 26, 26, 1);
    }

    .InputContainerModal:focus {
        box-shadow: 0 0 5px rgb(0, 0, 0);
    }

    .MainContainer button {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #428aff;
        border-radius: 12px;
        width: 100%;
        height: 60px;
        margin-top: 20px;
        border: none;
        color: #fff;
        font-size: 20px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .MainContainer button:hover {
        background: #649fff;
        cursor: pointer;
    }
</style>