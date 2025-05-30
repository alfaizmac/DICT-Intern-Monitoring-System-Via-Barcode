<style>
    * {
        margin: 0px;
        padding: 0px;
    }

    .bodymain {
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

    .bodyAdd {
        display: flex;
        flex-direction: column;
        justify-content: start;
        align-items: start;
        width: auto;
        height: auto;
        margin: 0 40px 0 40px;
        gap: 20px;
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
        align-items: start;
        width: 100%;
        height: 100%;
        gap: 20px;
        width: 570px;
        height: auto;
        border-radius: 8px;
        background: #fff;
    }

    .SecondContainer {
        display: flex;
        flex-direction: column;
        justify-content: start;
        align-items: start;
        width: 100%;
        height: 63px;
        align-items: center;
        gap: 15px;
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
        margin-bottom: 10px;
        margin-top: 30px;
        padding-left: 40px;
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
    }

    .WeekContainer {
        display: flex;
        flex-direction: column;
        justify-content: start;
        align-items: start;
        width: 100%;
        height: auto;
    }

    .inputWeek {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 150px;
        height: 63px;
        background-color: #fbfbfb;
        border-radius: 12px;
        border: solid 1px #9e9e9e;
    }

    .inputWeek input {
        width: 100%;
        height: 100%;
        background-color: #fbfbfb;
        border-radius: 12px;
        border: none;
        font-size: 16px;
        font-weight: 400;
        color: #222;
        padding-left: 30px;
        padding-right: 15px;
    }

    .inputWeek input:focus {
        outline: none;
        box-shadow: 0px 0px 4px 4px rgba(0, 0, 0, 0.1);
    }

    .inputDescriptions {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        background-color: #fbfbfb;
        border-radius: 12px;
        border: solid 1px #9e9e9e;
    }

    .inputDescriptions textarea {
        width: 100%;
        height: 100%;
        background-color: #fbfbfb;
        border-radius: 12px;
        border: none;
        font-size: 16px;
        font-weight: 400;
        color: #222;
        padding: 15px;
    }

    .inputDescriptions textarea:focus {
        outline: none;
        box-shadow: 0px 0px 4px 4px rgba(0, 0, 0, 0.1);
    }

    .inputLearned {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        background-color: #fbfbfb;
        border-radius: 12px;
        border: solid 1px #9e9e9e;
    }

    .inputLearned textarea {
        width: 100%;
        height: 100%;
        background-color: #fbfbfb;
        border-radius: 12px;
        border: none;
        font-size: 16px;
        font-weight: 400;
        color: #222;
        padding: 15px;
    }

    .inputLearned textarea:focus {
        outline: none;
        box-shadow: 0px 0px 4px 4px rgba(0, 0, 0, 0.1);
    }

    .DescriptionContainer {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: auto;
    }

    .LearnedContainer {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: auto;
    }

    .TitleAdd {
        margin-bottom: 10px;
        font-weight: 500;
    }
</style>
<div class="bodymain">
    <div class="FirstContainer">
        <div class="head">
            <div class="title">
                <h1>Add Weekly Reflection</h1>
            </div>
            <div class="ContainerClose">
                <svg class="close" width="32" height="32" fill="none" stroke="#222" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="m18.75 5.25-13.5 13.5"></path>
                    <path d="M18.75 18.75 5.25 5.25"></path>
                </svg>
            </div>
        </div>
        <div class="bodyAdd">
            <div class="WeekContainer">
                <div class="TitleAdd">Week</div>
                <div class="inputWeek"><input type="text"></div>
            </div>
            <div class="DescriptionContainer">
                <div class="TitleAdd">Description</div>
                <div class="inputDescriptions"><textarea name="paragraph_input" rows="4" cols="50"></textarea></div>
            </div>
            <div class="LearnedContainer">
                <div class="TitleAdd">Lesson/Skills Learned</div>
                <div class="inputLearned"><textarea name="paragraph_input" rows="4" cols="50"></textarea></div>
            </div>
        </div>
        <div class="ButtonContainer">
            <button>Submit</button>
        </div>
    </div>
</div>