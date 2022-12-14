import Brand from "./Brand.vue";
import Icon from "./Icon.vue";
import Pagination from "./Pagination.vue";
import Link from "./Buttons/Link.vue";
import Button from "./Buttons/Button.vue";

/**
 * Containers
 */
import BasicContainer from "./Containers/BasicContainer.vue";

/**
 * Buttons
 */
import PanelButton from "./Buttons/PanelButton.vue";

/**
 * Table
 */
import Table from "./Tables/Table.vue";
import TableHeader from "./Tables/TableHeader.vue";
import TableCell from "./Tables/TableCell.vue";
import ApiTable from "./Tables/ApiTable.vue";

/**
 * Panels
 */
import Panel from "./Panels/Panel.vue";
import panelScript from "./Panels/panelScript";

/**
 * Forms
 */
import SearchInput from "./Forms/SearchInput.vue";
import Input from "./Forms/Input.vue";
import Form from "./Forms/Form.vue";
import Select from "./Forms/Select.vue";
import Checkbox from "./Forms/Checkbox.vue"
import Textarea from "./Forms/Textarea.vue"

/**
 * Spinners
 */
import Loading from "./Loading.vue"

/**
 * Cards
 */
import CardLayout from "./Cards/CardLayout.vue";
import CardTable from "./Cards/CardTable.vue"

/**
 * Alerts
 */
import Alert from "./Alerts/Alert.vue";

/**
 * Pills
 */
import Pill from "./Badges/Pill.vue";

/**
 * Tooltips
 */
import Tooltip from "./Tooltips/Tooltip.vue";

export {
    Icon,
    Brand as UiBrand,
    Pagination as UiPagination,

    /**
     * Containers
     */
    BasicContainer,

    /**
     * Buttons
     */
    Link as UiLink,
    Button as UiButton,
    PanelButton,

    /**
     * Table
     */
    Table as UiTable,
    TableHeader as UiTh,
    TableCell as UiTd,
    ApiTable as UiApiTable,

    /**
     * Panles
     */
    Panel as UiPanel,
    panelScript,

    /**
     * Forms
     */
    SearchInput,
    Input as UiInput,
    Form as UiForm,
    Select as UiSelect,
    Checkbox as UiCheckbox,
    Textarea as UiTextarea,

    /**
     * Spinners
     */
    Loading as UiLoading,

    /**
     * Cards
     */
    CardLayout,
    CardTable,

    /**
     * Alerts
     */
    Alert as UiAlert,

    /**
     * Pills
     */
    Pill as UiPill,

    /**
     * Tooltips
     */
    Tooltip as UiToolTip,
}