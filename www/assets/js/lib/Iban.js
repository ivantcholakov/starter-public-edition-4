Iban = function() {
};
Iban.prototype.countries = {
	'AL': 28,
	'AD': 24,
	'AZ': 28,
	'BH': 22,
	'BE': 16,
	'BA': 20,
	'BR': 29,
	'BG': 22,
	'CR': 21,
	'DK': 18,
	'DE': 22,
	'DO': 28,
	'EE': 20,
	'FO': 18,
	'FI': 18,
	'FR': 27,
	'GF': 27,
	'PF': 27,
	'TF': 27,
	'GE': 22,
	'GI': 23,
	'GR': 27,
	'GL': 18,
	'GP': 27,
	'GT': 28,
	'HK': 16,
	'IE': 22,
	'IS': 26,
	'IL': 23,
	'IT': 27,
	'JO': 30,
	'VG': 24,
	'KZ': 20,
	'QA': 29,
	'HR': 21,
	'KW': 30,
	'LV': 21,
	'LB': 28,
	'LI': 21,
	'LT': 20,
	'LU': 20,
	'MT': 31,
	'MA': 24,
	'MQ': 27,
	'MR': 27,
	'MU': 30,
	'YT': 27,
	'MK': 19,
	'MD': 24,
	'MC': 27,
	'ME': 22,
	'NC': 27,
	'NL': 18,
	'NO': 15,
	'AT': 20,
	'PK': 24,
	'PS': 29,
	'PL': 28,
	'PT': 25,
	'RE': 27,
	'RO': 24,
	'BL': 27,
	'MF': 27,
	'SM': 27,
	'SA': 24,
	'SE': 24,
	'CH': 21,
	'RS': 22,
	'SK': 24,
	'SI': 19,
	'ES': 24,
	'PM': 27,
	'CZ': 24,
	'TN': 24,
	'TR': 26,
	'HU': 28,
	'AE': 23,
	'GB': 22,
	'WF': 27,
	'CY': 28
};

Iban.prototype.alphabet = {
	'A': '10',
	'B': '11',
	'C': '12',
	'D': '13',
	'E': '14',
	'F': '15',
	'G': '16',
	'H': '17',
	'I': '18',
	'J': '19',
	'K': '20',
	'L': '21',
	'M': '22',
	'N': '23',
	'O': '24',
	'P': '25',
	'Q': '26',
	'R': '27',
	'S': '28',
	'T': '29',
	'U': '30',
	'V': '31',
	'W': '32',
	'X': '33',
	'Y': '34',
	'Z': '35'
};

Iban.prototype.iban = '';

Iban.prototype.validate = function(iban) {
	if (iban === undefined || iban === "") {
		return false;
	}

	//removing spaces
	iban = iban.replace(/\s+/g, "");

	this.iban = iban;

	if (!this.checkString) {
		return false;
	}

	if (!this.checkLength()) {
		return false;
	}

	this.changeCharacterPosition(iban);
	this.replaceLettersWithNumbers();

	ibanWithoutCheckDigits = this.iban.substr(0, this.iban.length - 2);
	ibanWithZeroCheckDigits = ibanWithoutCheckDigits + "00";
	ibanCheckDigits = this.iban.substr(this.iban.length - 2, 2);

	calcCheckDigits = (98 - this.calculate(ibanWithZeroCheckDigits)).toString();

	if (calcCheckDigits.length === 1) {
		calcCheckDigits = '0' + calcCheckDigits;
	}

	if (calcCheckDigits !== ibanCheckDigits) {
		return false;
	}

	if (this.calculate(this.iban) !== '01') {
		return false;
	}

	return true;
};

//checking if the given IBAN is alphanumeric, the first two positions are letters and the next two positions numbers
Iban.prototype.checkString = function() {
	return this.iban.match(/^[a-z]{2}[0-9]{2}[a-z0-9]+$/i) !== null;
};


//checking if the given IBAN has the right length based on the first two letters which have to be a country code
Iban.prototype.checkLength = function() {
	countryCode = this.iban.substr(0, 2);
	return this.countries[countryCode] === this.iban.length;
};

//Replace Letters with Numbers A = 10,....,Z = 35
Iban.prototype.replaceLettersWithNumbers = function() {
	for (character in this.alphabet) {
		regex = new RegExp(character, 'g');
		this.iban = this.iban.replace(regex, this.alphabet[character]);
	}
};

//Puts the first 4 Characters to the End
Iban.prototype.changeCharacterPosition = function() {
	firstFourCharacters = this.iban.substr(0, 4);
	leftOverString = this.iban.substr(4);
	this.iban = leftOverString + firstFourCharacters;
};

//calculate the IBAN Hash with piece-wise manner modulo operations, since javascript cant handle 128 bit integer
Iban.prototype.calculate = function(iban) {
	start = 0;
	length = 9;
	loop = true;
	remainder = '';
	while (loop) {
		if (iban.substr(start, length).length < 7) {
			loop = false;
			length = iban.substr(start, length).length;
		}
		tempInt = remainder + iban.substr(start, length);
		remainder = (tempInt % 97) + "";
		if (remainder.length === 1) {
			remainder = '0' + remainder;
		}
		start = start + length;
		length = 7;
	}
	return remainder;
};