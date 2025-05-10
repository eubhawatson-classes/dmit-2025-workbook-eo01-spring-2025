/* 
    Script for Range Slider

    While range sliders great for things like likert scales, it can be difficult for the user to see what value they've chosen. This little script updates the helper text under the range slider to display the value to the user.

    We want to do this on the front-end, not the back-end, because they will want to see it before submission.
*/
document.addEventListener('DOMContentLoaded', () => {
    const slider = document.getElementById('loyalty');
    const output = document.getElementById('loyalty-value');

    slider.addEventListener('input', () => {
        output.textContent = slider.value;
    });
});