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
        justify-content: center;
        align-items: center;
        width: 100%;
        height: auto;
    }

    .ModalContainer {
        width: 570px;
        height: 574px;
        border-radius: 8px;
        background: #fff;

    }

    .FirstContainer {
        display: flex;
        flex-direction: column;
        justify-content: start;
        align-items: center;
        width: 100%;
        height: 100%;
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
    }

    .FirstContainer .ButtonContainer button {
        display: flex;
        width: 150px;
        height: 63px;
        background: #428aff;
        align-items: center;
        justify-content: center;
        color: #fff;
        border-radius: 12px;
        border: none;
        font-size: 15px;
    }

    .title {
        display: flex;
        justify-content: start;
        width: 100%;
        height: 100%;
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

    h1 {
        display: flex;
        font-size: 24px;
        font-weight: Medium;
        color: #1b1b1b;
        padding-left: 40px;
    }
</style>
<div class="body">
    <div class="ModalContainer">
        <div class="FirstContainer">
            <div class="head">
                <div class="title">
                    <h1>Add New Intern</h1>
                </div>
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
                <label for="username">Username</label>
                <div class="InputContainer"></div>
            </div>
            <div class="SecondContainer">
                <label for="username">Password</label>
                <div class="InputContainer"></div>
            </div>
            <div class="SecondContainer">
                <label for="username">Required Hours</label>
                <div class="InputHourContainer"></div>
            </div>
            <div class="SecondContainer">
                <label for="username">Barcode</label>
                <button><Span>Download PNG</Span></button>
            </div>
            <div class="ButtonContainer">
                <button>Submit</button>
            </div>
        </div>
    </div>
</div>