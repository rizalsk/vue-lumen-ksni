import moment from 'moment';

export const formatDateString = (value, format = "YYYY-MM-DD HH:mm") => {
    if(moment(value, format, true).isValid()) return moment(value).format(format).toString();
    return null;
};