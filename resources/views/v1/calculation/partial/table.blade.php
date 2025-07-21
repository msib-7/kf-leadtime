
<thead>
    <tr>
        {{-- <th>No </th> --}}
        <th>Parent Lot</th>
        <th>Lot Number</th>
        <th>Kode Produk</th>
        <th>Jenis Sediaan</th>
        <th>Grup Minico</th>
        <th>Prod Line</th>
        {{-- <th>Waktu Transact Awal</th>
                                    <th>Waktu Transact Akhir</th>
                                    <th>Waktu Awal Ruah</th>
                                    <th>Waktu End Ruah</th>
                                    <th>Waktu Awal Kemas</th>
                                    <th>Waktu BPP</th>
                                    <th>Waktu Close Batch</th>
                                    <th>Waktu Release</th>
                                    <th>Waktu Shipping</th>
                                    <th>Target</th>
                                    <th>Status</th> --}}
        <th>Transact Mat Awal Release</th>
        <th>Transact Mat Awal Akhir</th>
        <th>WIP Bahan Baku</th>
        <th>Proses Produksi</th>
        <th>WIP Pro Kemas</th>
        <th>Kemas</th>
        <th>BPP Release FG</th>
        <th>Endruah Release FG</th>
        <th>BPP Closed</th>
        <th>Closed Release FG</th>
        <th>Transact Mat Awal Shipping</th>
        <th>Release FG Shipping</th>
        {{-- <th>Action</th>
                                    <th>Action</th>
                                    <th>Action</th> --}}
    </tr>
</thead>
<tbody>
    @isset($results)
        @foreach ($results as $r)
            {{-- <tr class="@if ($r->remark) has-remark @endif"
                                            @if ($r->remark) data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $r->remark }}" @endif> --}}
            {{-- <td>{{ $r->id }}</td> --}}
            <tr>
                <td>{{ $r->parent_lot_number }}</td>
                <td>{{ $r->lot_number }}</td>
                <td>{{ $r->kode_produk }}</td>
                <td>{{ $r->jenis_sediaan }}</td>
                <td>{{ $r->grup_minico }}</td>
                <td>{{ $r->prod_line }}</td>
                {{-- <td>{{ $r->waktu_transact_awal }}</td>
                                            <td>{{ $r->waktu_transact_akhir }}</td>
                                            <td>{{ $r->waktu_awal_ruah }}</td>
                                            <td>{{ $r->waktu_end_ruah }}</td>
                                            <td>{{ $r->waktu_awal_kemas }}</td>
                                            <td>{{ $r->waktu_bpp }}</td>
                                            <td>{{ $r->waktu_close_batch }}</td>
                                            <td>{{ $r->waktu_release }}</td>
                                            <td>{{ $r->waktu_shipping }}</td>
                                            <td>{{ $r->target }}</td>
                                            <td>{{ $r->status }}</td> --}}
                <td>{{ $r->transact_mat_awal_release }}</td>
                <td>{{ $r->transact_mat_awal_akhir }}</td>
                <td>{{ $r->wip_bahan_baku }}</td>
                <td>{{ $r->proses_produksi }}</td>
                <td>{{ $r->wip_pro_kemas }}</td>
                <td>{{ $r->kemas }}</td>
                <td>{{ $r->bpp_release_fg }}</td>
                <td>{{ $r->endruah_release_fg }}</td>
                <td>{{ $r->bpp_closed }}</td>
                <td>{{ $r->closed_release_fg }}</td>
                <td>{{ $r->transact_mat_awal_shipping }}</td>
                <td>{{ $r->release_fg_shipping }}</td>
                {{-- <td class="remark-cell @if ($r->remark) has-remark @endif"
                                                @if ($r->remark) title="{{ $r->remark }}" data-bs-toggle="tooltip" @endif>
                                                {{ $r->release_fg_shipping }}</td> --}}
                {{-- <td>
                                                    <a href="{{ route('grafana-menu.edit', $r->lot_number) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                </td> --}}
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="10">Tidak ada data ditemukan.</td>
        </tr>
    @endisset
</tbody>
