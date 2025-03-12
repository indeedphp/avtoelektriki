const color_result = document.getElementById('color_result');
const canvas = document.getElementById('palette');
const ctx = canvas.getContext('2d', { willReadFrequently: true });
const colorValue = document.getElementById('colorValue');

function createGradient() { // Создание градиента на canvas
    const gradient = ctx.createLinearGradient(0, 0, canvas.width, 0);
    gradient.addColorStop(0.3, 'white'); // белый цвет
    gradient.addColorStop(0.8, 'black'); // черный цвет
    gradient.addColorStop(0, 'red');
    gradient.addColorStop(1 / 6, 'orange');
    gradient.addColorStop(2 / 6, 'yellow');
    gradient.addColorStop(3 / 6, 'green');
    gradient.addColorStop(4 / 6, 'blue');
    gradient.addColorStop(5 / 6, 'indigo');
    gradient.addColorStop(1, 'violet');
    ctx.fillStyle = gradient; // Заполнение холста градиентом
    ctx.fillRect(0, 0, canvas.width, canvas.height);
}
// Функция для получения цвета по координатам на canv
function getColorUnderCursor(event) {

    const x = event.offsetX;
    const y = event.offsetY;
    // Получаем цвет пикселя в точке (x, y)
    const pixel = ctx.getImageData(x, y, 1, 1).data;
    // Преобразуем rgba в формат hex
    const hexColor = rgbToHex(pixel[0], pixel[1], pixel[2]);
    // Меняем фон на выбранный цвет
    console.log(hexColor);
    color_result.style.backgroundColor = hexColor;
}
// Функция для преобразования RGB в HEX
function rgbToHex(r, g, b) {
    return `#${(1 << 24 | (r << 16) | (g << 8) | b).toString(16).slice(1).toUpperCase()}`;
}

// Заполнение канваса градиентом
createGradient();
// Обработчик клика на canvas
canvas.addEventListener('click', getColorUnderCursor);

// код для получения палитры на 